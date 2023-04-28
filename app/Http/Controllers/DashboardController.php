<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){

            // get all events with their images
            $events=EventPromotion::with('eventImage', 'event')->paginate(10);
            
            return view('dashboard',compact('events'));
        }
    }
}
