<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAdvertisement;
use App\Models\EventAdvertisementImage;
use App\Models\Participant;
use App\Models\Tags;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewEventAdvertisementNotification;
use App\Notifications\NewEventNotification;

class EventAdvertisementController extends Controller
{
    public function viewEventAdvertisementDetail($event_advertisement_id)
    {

        $eventAdvertisement = EventAdvertisement::with('eventAdvertisementImage', 'event')->find($event_advertisement_id);
        if ($eventAdvertisement == null) {
            return view('404');
        }
        $isRegistered = false;
        $isFull = false;
        $isClose = false;
        if ($eventAdvertisement->participants->where('user_id', auth()->user()->id)->count() > 0) {
            $isRegistered = true;
        } elseif ($eventAdvertisement->participants->count() >= $eventAdvertisement->participant_limit) {
            $isFull = true;
        } elseif ($eventAdvertisement->advertisement_start_date < now() || $eventAdvertisement->advertisement_end_date > now()) {
            $isClose = true;
        }
        $authToken = Auth::user()->cometchat_auth_token;
        return view('eventManagement.eventAdvertisementDetailView', compact('eventAdvertisement', 'isRegistered', 'isFull', 'isClose', 'authToken'));
    }

    // To return the list of event advertisement for the club
    public function viewMyEventAdvertisement($event_id)
    {

        // if(auth()->user()->role == 'club'){
        //     $event = Event::find($event_id);
        //     if($event->club_id != auth()->user()->club->id){
        //         return redirect()->route('event.view')->with('error', 'You are not authorized to view this page');
        //     }
        // }
        $eventAdvertisements = EventAdvertisement::with('eventAdvertisementImage', 'event', 'tags')->where('event_id', $event_id)->paginate(10);


        return view('eventManagement.eventAdvertisementList', compact('eventAdvertisements', 'event_id'));
    }

    // split the string into array of tags
    function splitTag($tags)
    {
        $tagArray = preg_split('/[\s,]+/', $tags);
        $tagArray = array_map('trim', $tagArray);
        $tagArray = array_map('strtolower', $tagArray);
        $tagArray = array_unique($tagArray);
        $tagArray = array_filter($tagArray);
        $tagArray = array_values($tagArray);

        return $tagArray;
    }

    // Create new tags if the tags are not existing in the database
    function createNonExistingTags($splittedTags)
    {
        $existingTags = Tags::whereIn('tag_name', $splittedTags)->pluck('tag_name')->toArray();

        $newTags = array_diff($splittedTags, $existingTags);


        Tags::insert(array_map(function ($newTag) {
            return ['tag_name' => $newTag];
        }, $newTags));
    }

    // Validate input from the form
    function validateInput($input)
    {
        $messages = array(
            'advertisementTitle.required' => 'Advertisement Title is required',
            'advertisementDescription.required' => 'Advertisement Description is required',
            'advertisementImage.mimes' => 'Advertisement Image must be in jpeg, png, jpg, gif format',
            'advertisementImage.max' => 'Advertisement Image must be less than 500MB',
            'advertisementStartDate.required' => 'Advertisement Start Date  required',
            'advertisementEndDate.required' => 'Advertisement End Date required',
            'advertisementEndDate.after' => 'Advertisement End Date must be after the Start Date',
            'participantLimit.required' => 'Participant Limit is required',
            'participantLimit.integer' => 'Participant Limit must be an integer',
            'participantLimit.min' => 'Participant Limit must be at least 1',
            'advertisementTags.required' => 'Input at least 1 tag, separated by commas',
            'advertisementTags.string' => 'Tags must be a string',
            'advertisementTags.max' => 'Tags must be less than 255 characters',

        );


        Validator::make($input->all(), [
            'advertisementTitle' => ['required', 'string', 'max:255'],
            'advertisementDescription' => ['required', 'string', 'max:5000'],
            'advertisementImage' => ['mimes:jpeg,png,jpg,gif', 'max:512000'],
            'advertisementStartDate' => ['required', 'date'],
            'advertisementEndDate' => ['required', 'date','after:advertisementStartDate'],
            'participantLimit' => ['required', 'integer', 'min:1'],
            'advertisementTags' => ['required', 'string', 'max:255'],
        ], $messages)->validate();
    }

    // To return the list of event advertisement
    public function uploadImage($image, $eventAdvertisementId)
    {

        $eaImage = EventAdvertisementImage::where('event_advertisement_id', $eventAdvertisementId)->get();
        $newEventAdvertisementImage = new EventAdvertisementImage();

        if ($eaImage->count() > 0) {
            $imageFileName = $eaImage->first()->image_name;
            $s3 = \Illuminate\Support\Facades\Storage::disk('s3');
            $filePath = '/eventAdvertisement/' . $imageFileName;
            $s3->delete($filePath);

            $newEventAdvertisementImage = $eaImage->first();
        }
        $imageFileName = 'EAI' . $eventAdvertisementId . '.' . $image->getClientOriginalExtension();
        $s3 = Storage::disk('s3');
        $filePath = '/eventAdvertisement/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image));

        $newEventAdvertisementImage->event_advertisement_id = $eventAdvertisementId;
        $newEventAdvertisementImage->image_name = $imageFileName;
        $newEventAdvertisementImage->image_s3_key = $filePath;

        $newEventAdvertisementImage->save();
    }

    // To return the form for the club create or edit the event advertisement information
    public function eventAdvertisementForm($event_id, $event_advertisement_id = null)
    {
        $clubEvent = Event::find($event_id);
        // if eventAdvertisement already exist, retrieve the information
        if ($event_advertisement_id) {
            $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);
            return view(
                'eventManagement.eventAdvertisementDetails',
                compact('eventAdvertisement', 'clubEvent')
            );
        } else {
            return view(
                'eventManagement.eventAdvertisementDetails',
                compact('clubEvent')
            );
        }
    }

    // To append list of additional information as a single string separated by commas
    public function appendAdditionalInformation($request)
    {
        $additionalInformation = "";

        for ($i = 0; $i <= ($request->inputCounter); $i++) {
            // Check if the additional information is not empty (If user input additional information)

            if ($request->has('additionalInformation' . $i)) {
                $additionalInformation .=  $request['additionalInformation' . $i] . ", ";
            }
        }

        return  $additionalInformation;
    }

    public function pushNoti($event){
        Notification::send(User::all(),new NewEventNotification($event));
    }


    // To store the club event advertisement information (create or update)
    public function store(Request $request, $event_id, $event_advertisement_id = null)
    {
        $event = Event::find($event_id);
        $this->validateInput($request);

        $splittedTags = $this->splitTag($request->advertisementTags);
        $this->createNonExistingTags($splittedTags);


        if ($event_advertisement_id) {
            $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);

            $eventAdvertisement->advertisement_title = $request->advertisementTitle;
            $eventAdvertisement->advertisement_description = $request->advertisementDescription;
            $eventAdvertisement->advertisement_start_date = $request->advertisementStartDate;
            $eventAdvertisement->advertisement_end_date = $request->advertisementEndDate;
            $eventAdvertisement->participant_limit = $request->participantLimit;
            $eventAdvertisement->tags()->sync($splittedTags);
            if ($request->hasFile('advertisementImage')) {
                $this->uploadImage($request->file('advertisementImage'), $eventAdvertisement->id);
            }
            $eventAdvertisement->save();
            // Notify user on new event added
            $this->pushNoti($eventAdvertisement);
            return redirect()->route('event-advertisement-my-list.view', $event_id)->with('success', 'Event Advertisement Updated Successfully');
        } else {
            $eventAdvertisement = new EventAdvertisement();
            $eventAdvertisement->event_id = $event_id;
            $eventAdvertisement->advertisement_title = $request->advertisementTitle;
            $eventAdvertisement->advertisement_description = $request->advertisementDescription;
            $eventAdvertisement->advertisement_start_date = $request->advertisementStartDate;
            $eventAdvertisement->advertisement_end_date = $request->advertisementEndDate;
            $eventAdvertisement->participant_limit = $request->participantLimit;
            $eventAdvertisement->additional_information_key = $this->appendAdditionalInformation($request);
            $eventAdvertisement->save();
            $eventAdvertisement->tags()->sync($splittedTags);
            if ($request->hasFile('advertisementImage')) {
                $this->uploadImage($request->file('advertisementImage'), $eventAdvertisement->id);
            }

            $this->pushNoti($eventAdvertisement);


            return redirect()->route('event-advertisement-my-list.view', $event_id)->with('success', 'Event Advertisement Created Successfully');
        }
    }

    // Store  subscribe notification for new event advertisement
    public function subscribeNoti(Request $request)
    {
        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Auth::user();
        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true], 200);
    }




}
