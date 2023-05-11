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
            $formAction['route'] ?? 'event-advertisement.store',
            isset($eventAdvertisement)
                ? ['eventAdvertisementId' => $eventAdvertisement->id,'clubEventId' =>$clubEvent->id] //if there is clubEvent, then pass the id to the route else pass empty array
                : ['clubEventId' =>$clubEvent->id],
        ) }}">

        <x-validation-errors class="mb-4" />
        <div class="mb-2">
            <x-label for="advertisementTitle" value="{{ __('Advertisement Title') }}" />
            <x-custom-input id="advertisementTitle" class="block mt-1 w-full" type="text" name="advertisementTitle"
                :value="$eventAdvertisement->advertisement_title ?? ''" required autofocus
                autocomplete="Advertisement Title" placeholder="Enter title for your advertisement"/>
        </div>

        <div class="mb-2">
            <x-label for="advertisementDescription" value="{{ __('Advertisement Description') }}" />
            <x-custom-textarea name="advertisementDescription" placeholder="Enter advertisement description">{{ $eventAdvertisement->advertisement_description ?? '' }}</x-textarea>

        </div>

        <div class="mb-2">
            <x-label for="advertisementStartDate" value="{{ __('Advertisement Start Date') }}" />
            <x-custom-input id="advertisementStartDate" class="block mt-1 w-full" type="date"
                name="advertisementStartDate" :value="isset($eventAdvertisement)
                    ? $eventAdvertisement->advertisement_start_date
                    : ''" required autofocus
                autocomplete="Advertisement Start Date" />

        </div>

        <div class="mb-2">
            <x-label for="advertisementEndDate" value="{{ __('Advertisement End Date') }}" />
            <x-custom-input id="advertisementEndDate" class="block mt-1 w-full" type="date"
                name="advertisementEndDate" :value="isset($eventAdvertisement)
                    ? $eventAdvertisement->advertisement_end_date
                    : ''" required autofocus
                autocomplete="Advertisement End Date" />
        </div>
        <div class="mb-2">
            <x-label for="participantLimit" value="{{ __('Participant Limit') }}" />
            <x-custom-input id="participantLimit" class="block mt-1 w-full" type="number"
                name="participantLimit" :value="$eventAdvertisement->participant_limit ??''" required autofocus
                autocomplete=10  />
        </div>
        <div class="mb-2">
            <x-label for="advertisementTags" value="{{ __('Tags') }}" />
                        {{-- Space cannot be added for text area to avoid any extra space in the field later --}}

            <x-custom-textarea name="advertisementTags" placeholder="Add your tags here">@if (!empty($eventAdvertisement))@foreach ($eventAdvertisement->tags as $tag){{ $tag->tag_name }}@if (!$loop->last),@endif @endforeach @endif </x-custom-textarea>

        </div>
        <input type="file" name="file" id="file">


    </x-custom-form>


</x-app-layout>
