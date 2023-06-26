<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAdvertisement;
use App\Models\Participant;
use App\Models\RF_Status;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function isRegistered($eventAdvertisement)
    {
        // Check if the user is already registered for the event
        if ($eventAdvertisement->participants->where('user_id', auth()->user()->id)->count() > 0) {
            return false;
        }

        return true;
    }

    public function isReachParticipantLimit($eventAdvertisement)
    {
        // Check if the participant limit is reached
        if ($eventAdvertisement->participants->count() >= $eventAdvertisement->participant_limit) {
            return false;
        }

        return true;
    }

    public function create($event_advertisement_id)
    {
        $eventAdvertisement = EventAdvertisement::find($event_advertisement_id);

        //
        if (!$this->isRegistered($eventAdvertisement)) {
            return redirect()->route('event-advertisement.view', $event_advertisement_id)->with('error', 'You are already registered for this event');
        } elseif (!$this->isReachParticipantLimit($eventAdvertisement)) {
            return redirect()->route('event-advertisement.view', $event_advertisement_id)->with('error', 'The participant limit is reached');
        }


        return view('eventManagement.participantRegistration', compact('eventAdvertisement'));
    }

    public function store(Request $request, $event_advertisement_id)
    {
        // $request->validate([
        //     'additional_information' => 'required',
        // ]);
        $additionalInfoData = [];
        foreach ($request->all() as $key => $value) {
            if ($key != '_token' && $key != '_method' && $key != 'submitButton') {
                $additionalInfoData[$key] = $value;
            }
        }
        $jsonData = json_encode($additionalInfoData);

        $participant = new Participant();
        $participant->user_id = auth()->user()->id;
        $participant->event_advertisement_id = $event_advertisement_id;
        $participant->additional_information_json = $jsonData;
        $participant->register_date = now();
        $participant->save();

        return redirect()->route('event-advertisement.view', $event_advertisement_id)->with('success', 'You have successfully registered for the event');
    }

    public function viewParticipantList($eventAdvertisement_id)
    {
        // Get the list of participants for the event advertisement
        $participants = Participant::with('user')->where('event_advertisement_id', $eventAdvertisement_id)->paginate(9);
        //Get the event advertisement key for the json value stored
        $eventAdvertisement = EventAdvertisement::select('additional_information_key', 'id')->where('id', $eventAdvertisement_id)->first();

        $registrationStatuses = RF_Status::where('status_code', 'like', 'PR%')->pluck('status_name', 'status_code');
        return view('eventManagement.eventAdvertisementRegisteredParticipantList', compact('participants', 'eventAdvertisement', 'registrationStatuses'));
    }

    public function updateParticipantStatus(Request $request, $eventAdvertisement_id, $participant_id)
    {
        $participant = Participant::find($participant_id)->where('event_advertisement_id', $eventAdvertisement_id)->first();
        if (!$participant) {
            return redirect()->route('participant.viewParticipantList', $eventAdvertisement_id)->with('error', 'Participant not found');
        }
        $participant->registration_status = $request->input('participant_registration_status' . $request->iteration);
        $participant->save();
        return redirect()->route('participant.viewParticipantList', $eventAdvertisement_id)->with('success', 'Participant status updated');
    }

    public function viewEventRegistrationHistory()
    {
        $registeredEvents = Participant::join('event_advertisements', 'participants.event_advertisement_id', '=', 'event_advertisements.id')
            ->leftJoin('rf_statuses', 'participants.registration_status', '=', 'rf_statuses.status_code')
            ->where('participants.user_id', auth()->user()->id)
            ->leftJoin('e_certificates', 'participants.event_advertisement_id', '=', 'e_certificates.event_advertisement_id')
            ->select('event_advertisements.advertisement_title', 'participants.event_advertisement_id', 'rf_statuses.status_name', 'participants.register_date','e_certificates.ecertificate_status')
            ->orderBy('participants.register_date', 'desc')
            ->paginate(9);

        return view('eventManagement.registeredEvent', compact('registeredEvents'));
    }
}
