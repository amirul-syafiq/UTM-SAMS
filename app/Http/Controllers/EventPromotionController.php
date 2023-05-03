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
        $eventPromotions=EventPromotion::with('eventImage', 'event')->where('event_id',$event_id)->paginate(10);
        return view('eventManagement.promotionEventList', compact('eventPromotions'));
    }
}
