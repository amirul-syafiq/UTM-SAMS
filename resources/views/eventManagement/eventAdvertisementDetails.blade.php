<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @php
            @endphp
            {{ $clubEvent->event_name }}
            @if (isset($eventAdvertisement))
                {{ __(' > Edit Advertisement') }}
            @else
                {{ __('> Create New Advertisement') }}
            @endif
        </h2>
    </x-slot>

    <x-custom-form method="{{ $formAction['method'] ?? 'POST' }}" title="Please fill in all the detail"
        button-text="{{ $formAction['buttonText'] ?? 'Submit' }}"
        action="{{ route(
            $formAction['route'] ?? 'event.createEvent',
            isset($eventAdvertisement)
                ? ['eventAdvertisementId' => $eventAdvertisement->id] //if there is clubEvent, then pass the id to the route else pass empty array
                : [],
        ) }}">

        <x-validation-errors class="mb-4" />

        <div class="mb-2">
            <x-label for="advertisementDescription" value="{{ __('Advertisement Description') }}" />
            <x-custom-textarea name="advertisementDescription" placeholder="Enter Advertisement description">
                {{ $eventAdvertisement->Advertisement_description ?? '' }}</x-textarea>

        </div>

        <div class="mb-2">
            <x-label for="advertisementStartDateTime" value="{{ __('Advertisement Start Date and Time') }}" />
            <x-custom-input id="advertisementStartDateTime" class="block mt-1 w-full" type="datetime-local"
                name="advertisementStartDateTime" :value="isset($eventAdvertisement)
                    ? date('Y-m-d\TH:i', strtotime($eventAdvertisement->avertisement_start_date))
                    : ''" required autofocus
                autocomplete="Advertisement Start Date and Time" />
        </div>

        <div class="mb-2">
            <x-label for="AdvertisementEndDateTime" value="{{ __('Advertisement End Date and Time') }}" />
            <x-custom-input id="AdvertisementEndDateTime" class="block mt-1 w-full" type="datetime-local"
                name="AdvertisementEndDateTime" :value="isset($eventAdvertisement)
                    ? date('Y-m-d\TH:i', strtotime($eventAdvertisement->advertisement_end_date))
                    : ''" required autofocus
                autocomplete="Advertisement End Date and Time" />
        </div>
        <div class="mb-2">
            <x-label for="participantLimit" value="{{ __('Participant Limit') }}" />
            <x-custom-input id="participantLimit" class="block mt-1 w-full" type="number"
                name="participantLimit" :value="$eventAdvertisement->participant_limit ??''" required autofocus
                autocomplete=10  />
        </div>
        <div class="mb-2">
            <x-label for="tags" value="{{ __('Tags') }}" />
            <x-custom-textarea name="test">@foreach ($eventAdvertisement->tags as $tag){{$tag->tag_name }}@if (!$loop->last),@endif @endforeach</x-custom-textarea>

        </div>



    </x-custom-form>


</x-app-layout>
