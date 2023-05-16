<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAdvertisement;
use App\Models\EventAdvertisementImage;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EventAdvertisementController extends Controller
{
    public function index()
    {
        return view('eventManagement.eventAdvertisementList');
    }

    public function viewMyEventAdvertisement($event_id)
    {
        $eventAdvertisements = EventAdvertisement::with('eventAdvertisementImage', 'event', 'tags')->where('event_id', $event_id)->paginate(10);


        return view('eventManagement.eventAdvertisementList', compact('eventAdvertisements', 'event_id'));
    }

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

    function createNonExistingTags($splittedTags)
    {
        $existingTags = Tags::whereIn('tag_name', $splittedTags)->pluck('tag_name')->toArray();

        $newTags = array_diff($splittedTags, $existingTags);


        Tags::insert(array_map(function ($newTag) {
            return ['tag_name' => $newTag];
        }, $newTags));
    }

    function validateInput($input)
    {
        $messages = array(
            'advertisementTitle.required' => 'Advertisement Title is required',
            'advertisementDescription.required' => 'Advertisement Description is required',
            'advertisementImage.mimes' => 'Advertisement Image must be in jpeg, png, jpg, gif format',
            'advertisementImage.max' => 'Advertisement Image must be less than 500MB',
            'advertisementStartDate.required' => 'Advertisement Start Date  required',
            'advertisementEndDate.required' => 'Advertisement End Date required',
            'participantLimit.required' => 'Participant Limit is required',
            'participantLimit.integer' => 'Participant Limit must be an integer',
            'participantLimit.min' => 'Participant Limit must be at least 1',
            'advertisementTags.required' => 'Input at least 1 tag, separated by commas',
            'advertisementTags.string' => 'Tags must be a string',
            'advertisementTags.max' => 'Tags must be less than 255 characters',

        );


        Validator::make($input->all(), [
            'advertisementTitle' => ['required', 'string', 'max:255'],
            'advertisementDescription' => ['required', 'string', 'max:255'],
            'advertisementImage' => ['mimes:jpeg,png,jpg,gif', 'max:512000'],
            'advertisementStartDate' => ['required', 'date'],
            'advertisementEndDate' => ['required', 'date'],
            'participantLimit' => ['required', 'integer', 'min:1'],
            'advertisementTags' => ['required', 'string', 'max:255'],
        ], $messages)->validate();
    }

    public function uploadImage($image, $eventAdvertisementId){

        $eaImage=EventAdvertisementImage::where('event_advertisement_id', $eventAdvertisementId)->get();

        if($eaImage->count() > 0){
            $imageFileName = $eaImage->first()->image_name;
            $s3 = \Illuminate\Support\Facades\Storage::disk('s3');
            $filePath = '/test2/' . $imageFileName;
            $s3->delete($filePath);
        }
        $imageFileName = 'EAI'.$eventAdvertisementId .'.' . $image->getClientOriginalExtension();
        $s3 = Storage::disk('s3');
        $filePath = '/eventAdvertisement/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image));

        $newEventAdvertisementImage= new EventAdvertisementImage();
        $newEventAdvertisementImage->event_advertisement_id=$eventAdvertisementId;
        $newEventAdvertisementImage->image_name=$imageFileName;
        $newEventAdvertisementImage->image_s3_key=$filePath;
        $newEventAdvertisementImage->save();
    }

    public function eventAdvertisementForm($event_id, $event_advertisement_id = null)
    {
        $clubEvent = Event::find($event_id);
        if ($event_advertisement_id) {
            $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);
            return view('eventManagement.eventAdvertisementDetails', compact('eventAdvertisement', 'clubEvent'));
        } else {
            return view('eventManagement.eventAdvertisementDetails', compact('clubEvent'));
        }
    }

    public function store(Request $request, $event_id, $event_advertisement_id = null)
    {
        $event = Event::find($event_id);
        $this->validateInput($request);

        $splittedTags = $this->splitTag($request->advertisementTags);
        $this->createNonExistingTags($splittedTags);


        if ($event_advertisement_id) {
            $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);

            $eventAdvertisement->update($request->all());
            $eventAdvertisement->tags()->sync($splittedTags);
            return redirect()->route('event-advertisement.view', $event_id)->with('success', 'Event Advertisement Updated Successfully');
        } else {
            $eventAdvertisement = new EventAdvertisement();
            $eventAdvertisement->event_id = $event_id;
            $eventAdvertisement->advertisement_title = $request->advertisementTitle;
            $eventAdvertisement->advertisement_description = $request->advertisementDescription;
            $eventAdvertisement->advertisement_start_date = $request->advertisementStartDate;
            $eventAdvertisement->advertisement_end_date= $request->advertisementEndDate;
            $eventAdvertisement->participant_limit = $request->participantLimit;

            $eventAdvertisement->save();
            $eventAdvertisement->tags()->sync($splittedTags);
            if ($request->hasFile('advertisementImage')) {
                $this->uploadImage($request->file('advertisementImage'), $eventAdvertisement->id);
            }

            return redirect()->route('event-advertisement.view', $event_id)->with('success', 'Event Advertisement Created Successfully');
        }
    }
}