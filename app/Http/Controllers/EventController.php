<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\RF_Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    function validateInput($input)
    {
        $messages = array(
            'eventName' => 'Event name is required',
            'eventDescription' => 'Event description is required',
            'eventRefNo' => 'Event reference number is required! Please refer to ACAD system',
            'eventType' => 'Event type is required',
            'eventVenue' => 'Event venue is required',
            'eventStartDateTime' => 'Event start date and time is required',
            'eventStartDateTime.before' => 'The start date and time must be before the end date and time.',
            'eventEndDateTime' => 'Event end date and time is required',
            'eventStatus' => 'Event status is required',
        );


        Validator::make($input->all(), [
            'eventName' => ['required', 'string', 'max:255'],
            'eventDescription' => ['required', 'string', 'max:255'],
            'eventRefNo' => ['required', 'string', 'max:255'],
            'eventType' => ['required', 'string', 'max:255'],
            'eventVenue' => ['required', 'string', 'max:255'],
            'eventStartDateTime' => ['required', 'date_format:Y-m-d\TH:i', 'before:eventEndDateTime'],
            'eventEndDateTime' => ['required', 'date_format:Y-m-d\TH:i'],
            'eventStatus' => ['required', 'string', 'max:255'],
        ], $messages)->validate();


    }

    function checkEventStatus($input){

        if($input['eventStartDateTime'] > now()&& $input['eventEndDateTime'] > now()) {
            $input['eventStatus'] = 'EV03'; //event ended
        }elseif($input['eventStartDateTime'] >now()&& $input['eventEndDateTime'] < now()){
            $input['eventStatus'] = 'EV02';//event ongoing
        }elseif($input['eventStartDateTime'] < now()&& $input['eventEndDateTime'] < now()){
            $input['eventStatus'] = 'EV01';//event upcoming

    }
    }

    public function createEvent(Request $input)
    {
        $this->validateInput($input);

        // This method uses instead of normal create because event_organizer is guarded
        $newEvent = new Event();
        $newEvent->event_name = $input['eventName'];
        $newEvent->event_description = $input['eventDescription'];
        $newEvent->event_ref_no = $input['eventRefNo'];
        $newEvent->event_type = $input['eventType'];
        $newEvent->event_venue = $input['eventVenue'];
        $newEvent->event_start_date = $input['eventStartDateTime'];
        $newEvent->event_end_date = $input['eventEndDateTime'];
        $newEvent->event_status = $input['eventStatus'];
        $newEvent->event_organizer = Auth::user()->id;
        $newEvent->save();

        return redirect()->route('createEventForm')->with('success', 'Event created successfully!');
    }


    public function viewEvent()
    {
        // $clubEvents = Event::where('event_organizer', Auth::user()->id)
        //                 ->with('eventStatus')
        //             ->get();
        $clubEvents = Event::select('events.*', 'rf_statuses.status_name')
            ->where('event_organizer', Auth::user()->id)
            ->leftJoin('rf_statuses', 'events.event_status', '=', 'status_code')
            ->get();
        return view('eventManagement.clubEventList', compact('clubEvents'));
    }

    // return form for edit event details
    public function editEventDetails($eventId)
    {
        $clubEvent = Event::where('id', $eventId)->first();

        $formAction=[
            'route'=>'event.updateEvent',
            'method'=>'PUT',
            'buttonText'=>'Update Event',
        ];
        return view('eventManagement.eventDetails', compact('clubEvent', 'formAction'));
    }

    public function updateEvent(Request $input, $eventId)
    {
        $this->validateInput($input);

        if (Auth::user()->id != Event::where('id', $eventId)->first()->event_organizer) {
            return redirect()->route('event.viewEvent')->with('error', 'You are not authorized to edit this event!');
        }
        $updateEvent = Event::where('id', $eventId)->first();
        $updateEvent->event_name = $input['eventName'];
        $updateEvent->event_description = $input['eventDescription'];
        $updateEvent->event_ref_no = $input['eventRefNo'];
        $updateEvent->event_type = $input['eventType'];
        $updateEvent->event_venue = $input['eventVenue'];
        $updateEvent->event_start_date = $input['eventStartDateTime'];
        $updateEvent->event_end_date = $input['eventEndDateTime'];
        $updateEvent->event_status = $input['eventStatus'];
        $updateEvent->save();

        return $this->viewEvent();;
    }

}
