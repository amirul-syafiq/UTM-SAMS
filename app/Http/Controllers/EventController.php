<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function createEvent(Request $input)
    {
        $messages = array(
            'eventName' => 'Event name is required',
            'eventDescription' => 'Event description is required',
            'eventRefNo' => 'Event reference number is required! Please refer to ACAD system',
            'eventType' => 'Event type is required',
            'eventVenue' => 'Event venue is required',
            'eventStartDateTime' => 'Event start date and time is required',
            'eventEndDateTime' => 'Event end date and time is required',
            'eventStatus' => 'Event status is required',
        );

Validator::make($input->all(),[
    'eventName' => ['required', 'string', 'max:255'],
    'eventDescription' => ['required', 'string', 'max:255'],
    'eventRefNo' => ['required', 'string', 'max:255'],
    'eventType' => ['required', 'string', 'max:255'],
    'eventVenue' => ['required', 'string', 'max:255'],
    'eventStartDateTime' => ['required', 'string', 'max:255'],
    'eventEndDateTime' => ['required', 'string', 'max:255'],
    'eventStatus' => ['required', 'string', 'max:255'],
], $messages)->validate();

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

        return redirect()->route('createEventForm')->with('success', 'Event created successfully!');}

}
