<x-app-layout>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Participant Registration') }}
        </h2>
    </x-slot>

    <x-custom-container>

        <p>Please be informed by registering to this event, your profile will be
            shared with the organizer</p>


    </x-custom-container>
    {{-- Form to request additional information --}}
    <x-custom-form method="{{ $formAction['method'] ?? 'POST' }}"
        title="Please fill in the additional detail required by the organizer"
        action="{{ route($formAction['route'] ?? 'participant.store',
                ['event_id' => $eventAdvertisement->id]) }}"
        buttonText="Register">

        {{-- Iterate the list of additional information that is requested by organizer --}}
        @foreach ($eventAdvertisement->additional_informations as $additionalInformation)
            @php
                // Convert the additional information to camel case
                $camelCaseName = str_replace(' ', '', ucwords($additionalInformation));
            @endphp

           {{-- Dynamically display the input field --}}
            <x-label>{{ $additionalInformation }}</x-label>
            <x-input type="text" name="{{ $camelCaseName }}" placeholder="{{ $additionalInformation }}" />
        @endforeach

    </x-custom-form>
</x-app-layout>
