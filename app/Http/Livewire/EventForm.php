<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventForm extends Component
{
    public $eventName;
    public $eventDescription;
    public $eventVenue;
    public $eventStartDateTime;
    public $eventEndDateTime;
    public $eventRefNo;
    public $eventType;
    public $eventStatus;
    public $eventOrganizer;


    public function createEvent()
    {
        $this->validate([
            'eventName' => 'required',
            'eventDescription' => 'required',
            'eventVenue' => 'required',
            'eventStartDateTime' => 'required',
            'eventEndDateTime' => 'required',
            'eventRefNo' => 'required',

        ]);

        $newEvent=new Event();
        $newEvent->fill([
            'event_name' => $this->eventName,
            'event_description' => $this->eventDescription,
            'event_venue' => $this->eventVenue,
            'event_start_date' => $this->eventStartDateTime,
            'event_end_date' => $this->eventEndDateTime,
            'event_ref_no' => $this->eventRefNo,
            'event_type' => $this->eventType,
        ]);
        // event organizer is guarded so cannot use mass assignment
        $newEvent->event_organizer=Auth::id();
        $newEvent->event_status="pending";
        $newEvent->save();

        session()->flash('message', 'Event successfully created.');

        $this->resetInputFields();

        $this->emit('eventAdded');
    }

    public function render()
    {
        return view('livewire.event-form');
    }
}
