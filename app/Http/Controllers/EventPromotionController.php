<?php

namespace App\Http\Controllers;

use App\Models\EventPromotion;
use Illuminate\Http\Request;

class EventPromotionController extends Controller
{
    public function index()
    {
        return view('event-promotion');
    }

    public function viewMyEventPromotion($event_id)
    {
        $eventPromotion=EventPromotion::where('event_id', $event_id)->get();
        return view('eventManagement.promotionEventList', compact('eventPromotion'));
    }
}
