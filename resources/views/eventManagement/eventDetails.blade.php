<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            @if (isset($clubEvent))
                {{ __('Edit Event') }}
            @else
                {{ __('Create Event') }}
            @endif
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <x-custom-form method="{{ $formAction['method'] ?? 'POST' }}" title="Please fill in all the detail"
        button-text="{{ $formAction['buttonText'] ?? 'Submit' }}"
        action="{{ route(
            $formAction['route'] ?? 'event.createEvent',
            isset($clubEvent)
                ? ['eventId' => $clubEvent->id] //if there is clubEvent, then pass the id to the route else pass empty array
                : []
        ) }}">



        <x-validation-errors class="mb-4" />

        <div>
            <x-label for="eventName" value="{{ __('Event Name') }}" />
            <x-custom-input id="eventName" class="block mt-1 w-full" type="text" name="eventName" :value="$clubEvent->event_name ?? ''"
                required autofocus autocomplete="Event Name" />

        </div>

        <div>
            <x-label for="eventDescription" value="{{ __('Event Description') }}" />
            <x-custom-input id="eventDescription" class="block mt-1 w-full" type="text" name="eventDescription"
                :value="$clubEvent->event_description ?? ''" required autofocus autocomplete="Event Description" />

        </div>

        <div>
            <x-label for="eventRefNo" value="{{ __('Event Reference Number') }}" />
            <x-custom-input id="eventRefNo" class="block mt-1 w-full" type="text" name="eventRefNo" :value="$clubEvent->event_ref_no ?? ''"
                required autofocus autocomplete="Event Reference Number" />

        </div>

        <div>
            @php
                $eventTypeList = App\Models\EventType::all()->pluck('event_type_name', 'id');
            @endphp
            <x-custom-dropdown name="eventType" :options="$eventTypeList" :selected="$clubEvent->event_type ?? 'old(eventTypeList)'" label="Event Type" />
        </div>

        <div>
            <x-label for="eventVenue" value="{{ __('Event Venue') }}" />
            <x-custom-input id="eventVenue" class="block mt-1 w-full" type="text" name="eventVenue" :value="$clubEvent->event_venue ?? ''"
                required autofocus autocomplete="Event Venue" />

        </div>

        <div>
            <x-label for="eventStartDateTime" value="{{ __('Event Start Date and Time') }}" />
            <x-custom-input id="eventStartDateTime" class="block mt-1 w-full" type="datetime-local"
                name="eventStartDateTime" :value="isset($clubEvent) ? date('Y-m-d\TH:i', strtotime($clubEvent->event_start_date)) : ''"
                required autofocus autocomplete="Event Start Date and Time" />
        </div>

        <div>
            <x-label for="eventEndDateTime" value="{{ __('Event End Date and Time') }}" />
            <x-custom-input id="eventEndDateTime" class="block mt-1 w-full" type="datetime-local"
                name="eventEndDateTime" :value="isset($clubEvent) ? date('Y-m-d\TH:i', strtotime($clubEvent->event_end_date)) : ''"
                required autofocus autocomplete="Event End Date and Time" />
        </div>


        <div>
            @php
                $eventStatusList = App\Models\RF_Status::where('status_code', 'like', '%EV%')->pluck('status_name', 'status_code');
            @endphp

            <x-custom-dropdown name="eventStatus" :options="$eventStatusList" :selected="$clubEvent->event_status ?? 'old(eventStatusList)'" label="Event Status" />
        </div>

    </x-custom-form>

</x-app-layout>
