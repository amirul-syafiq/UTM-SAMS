<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <x-custom-form title="Please fill in all the detail" button-text="Create Event" action="{{ route('event.createEvent') }}">
        <div>
            <x-label for="eventName" value="{{ __('Event Name') }}" />
            <x-input id="Name" class="block mt-1 w-full" type="text" name="eventName" :value="old('name')" required autofocus autocomplete="Event Name" />
        </div>

        <div>
            <x-label for="eventDescription" value="{{ __('Event Description') }}" />
            <x-input id="eventDescription" class="block mt-1 w-full" type="text" name="eventDescription" :value="old('eventDescription')" required autofocus autocomplete="Event Description" />
        </div>

        <div>
            <x-label for="eventRefNo" value="{{ __('Event Reference Number') }}" />
            <x-input id="eventRefNo" class="block mt-1 w-full" type="text" name="eventRefNo" :value="old('eventRefNo')" required autofocus autocomplete="Event Reference Number" />
        </div>

        <div>
            @php
            $eventTypeList = App\Models\EventType::all()->pluck('event_type_name', 'id');
            @endphp
            <x-custom-dropdown name="eventType" :options="$eventTypeList" selected="old(eventTypeList)" label="Event Type" />
        </div>

    </x-custom-form>


</x-app-layout>
