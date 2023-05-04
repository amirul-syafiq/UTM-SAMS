<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAdvertisement;
use Illuminate\Http\Request;

class EventAdvertisementController extends Controller
{
    public function index()
    {
        return view('event-Advertisement');
    }

    public function viewMyEventAdvertisement($event_id)
    {
        $eventAdvertisements = EventAdvertisement::with('eventAdvertisementImage', 'event')->where('event_id', $event_id)->paginate(10);


        return view('eventManagement.AdvertisementEventList', compact('eventAdvertisements', 'event_id'));
    }

    public function eventAdvertisementForm($event_id, $event_Advertisement_id = null)
    {
        $clubEvent = Event::find($event_id);
        if ($event_Advertisement_id) {
            $eventAdvertisement = EventAdvertisement::find($event_Advertisement_id);
            return view('eventManagement.eventAdvertisementDetails', compact('eventAdvertisement', 'clubEvent'));
        } else {
            return view('eventManagement.eventAdvertisementDetails', compact('clubEvent'));
        }
    }


}
