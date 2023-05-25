<?php

namespace App\Http\Controllers;

use App\Models\EventAdvertisement;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function isRegistered($eventAdvertisement){
        // Check if the user is already registered for the event
        if($eventAdvertisement->participants->where('user_id', auth()->user()->id)->count() > 0){
            return false;
        }

        return true;
    }

    public function isReachParticipantLimit($eventAdvertisement){
        // Check if the participant limit is reached
        if($eventAdvertisement->participants->count() >= $eventAdvertisement->participant_limit){
            return false;
        }

        return true;
    }

    public function create($event_advertisement_id){
        $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);

        //
        if(!$this->isRegistered($eventAdvertisement)){
            return redirect()->route('event-advertisement.view',$event_advertisement_id)->with('error', 'You are already registered for this event');
        }
        elseif(!$this->isReachParticipantLimit($eventAdvertisement)){
            return redirect()->route('event-advertisement.view',$event_advertisement_id)->with('error', 'The participant limit is reached');
        }


        return view('eventManagement.participantRegistration', compact('eventAdvertisement'));

    }

    public function store(Request $request, $event_advertisement_id){
        // $request->validate([
        //     'additional_information' => 'required',
        // ]);
            $additionalInfoData = [];
            foreach($request->all() as $key => $value){
               if($key != '_token'&& $key != '_method' && $key != 'submitButton'){
                   $additionalInfoData[$key] = $value;
               }
            }
            $jsonData = json_encode($additionalInfoData);

            $participant= new Participant();
            $participant->user_id = auth()->user()->id;
            $participant->event_advertisement_id = $event_advertisement_id;
            $participant->additional_information_json = $jsonData;
            $participant->register_date = now();
            $participant->save();

            return redirect()->route('event-advertisement.view',$event_advertisement_id)->with('success', 'You have successfully registered for the event');
    }
}
