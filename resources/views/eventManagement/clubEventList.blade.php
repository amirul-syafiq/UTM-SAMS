<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Club Event List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 w-20">No.</th>
                            <th class="px-4 py-2">Event Name</th>
                            <th class="px-4 py-2">Event Description</th>
                            <th class="px-4 py-2">Event Reference Number</th>
                            <th class="px-4 py-2">Event Type</th>
                            <th class="px-4 py-2">Event Venue</th>
                            <th class="px-4 py-2">Event Start Date and Time</th>
                            <th class="px-4 py-2">Event End Date and Time</th>
                            <th class="px-4 py-2">Event Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clubEvents as $clubEvent)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->event_name }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->event_description }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->event_ref_no }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->event_type }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->event_venue }}</td>
                                <td class="border px-4 py-2">{{  \Carbon\Carbon::parse($clubEvent->event_start_date)->toDayDateTimeString() }}</td>
                                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($clubEvent->event_end_date)->toDayDateTimeString() }}</td>
                                <td class="border px-4 py-2">{{ $clubEvent->status_name }}</td>
                                <td class="border px-4 py-2">
                                     <a href="{{ route('event.editEventDetails', $clubEvent->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        <br>
                                    <a href="{{ route('event-promotion.viewMyEventPromotion',['event_id'=>$clubEvent->id]) }}"
                                        class= "bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Promote</a>
                                    {{-- <a href="{{ route('event.deleteEvent', $clubEvent->id) }}"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</a> --}}
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
