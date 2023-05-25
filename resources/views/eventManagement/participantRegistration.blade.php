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

        <p>Please be informed by registering to this event, your profile will be shared with the organizer</p>


    </x-custom-container>
    <x-custom-form method="{{ $formAction['method'] ?? 'POST' }}"
        title="Please fill in the additional detail required by the organizer"
        action="{{ route($formAction['route'] ?? 'participant.store', ['event_id' => $eventAdvertisement->id]) }}"
        buttonText="Register">

        @foreach ($eventAdvertisement->additional_informations as $additionalInformation)
            @php
                $camelCaseName = str_replace(' ', '', ucwords($additionalInformation));
            @endphp
            <x-label>{{ $additionalInformation }}</x-label>
            <x-input type="text" name="{{ $camelCaseName }}" placeholder="{{ $additionalInformation }}" />
        @endforeach


    </x-custom-form>
</x-app-layout>
