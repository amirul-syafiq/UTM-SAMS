<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventAdvertisement;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all advertisement which is active by checking the start and end date
        $events = EventAdvertisement::with('eventAdvertisementImage', 'event', 'tags')
            ->where('advertisement_start_date', '<=', now())
            ->where('advertisement_end_date', '>=', now())
            ->where(function ($query) {
                $query->where('advertisement_status', '=', 'EV01')
                    ->orWhere('advertisement_status', '=', 'EV02');
            })

            ->paginate(9);

        return view('dashboard', compact('events'));
    }

    // Function to search event
    public function searchEvent(Request $request)
    {
        $eventFilters = [
            ['event_type', 'like', "%" . $request->event_type],
            ['event_start_date', '=', $request->event_start_date],
            ['event_end_date', '=', $request->event_end_date]
        ];

        // Fetch all advertisement which is active by checking the start and end date
        $filteredResult = EventAdvertisement::with('eventAdvertisementImage', 'event', 'tags')
            ->where('advertisement_start_date', '<=', now())
            ->where('advertisement_end_date', '>=', now())
            ->where(function ($query) {
                $query->where('advertisement_status', '=', 'EV01')
                    ->orWhere('advertisement_status', '=', 'EV02');
            })
            ->where(function ($query) use ($request) {
                $query->whereHas('event', function ($query) use ($request) {
                    $query->where('event_name', 'like', '%' . $request->event_search_keyword . '%');
                })
                    ->orWhereHas('tags', function ($query) use ($request) {
                        $query->where('tags.tag_name', '=', $request->event_search_keyword);
                    })
                    ->orWhere('advertisement_title', 'like', '%' . $request->event_search_keyword . '%');
            })
            // ->whereHas('event', function ($query) use ($eventFilters) {
            //     $query->where($eventFilters);
            // })
            ->paginate(9);

        $events = $filteredResult;


        return view('dashboard', compact('events'));
    }
}
