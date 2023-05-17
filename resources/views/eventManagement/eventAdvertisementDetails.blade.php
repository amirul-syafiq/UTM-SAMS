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
        ) }}" >

        <x-validation-errors class="mb-4" />
        <div class="flex flex-col md:flex-row ">
            <div class="w-full md:w-2/5 md:pr-4">
                <div class="mb-2">
                    <x-label for="advertisementImage" value="{{ __('Upload Image') }}" />
                    <input type="file" name="advertisementImage" id="advertisementImage" onchange="previewImage(event)" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="mb-2">
                    @if(isset($eventAdvertisement) && isset($eventAdvertisement->eventAdvertisementImage))
                        <img id="advertisementImagePreview" src="{{ $eventAdvertisement->eventAdvertisementImage->imageUrl ? $eventAdvertisement->eventAdvertisementImage->imageUrl : '#' }}" alt="Advertisement Image Preview" class="w-3/4 {{ $eventAdvertisement->eventAdvertisementImage->imageUrl ? '' : 'hidden' }}">
                    @else
                        <img id="advertisementImagePreview" src="#" alt="Advertisement Image Preview" class="w-3/4 hidden">
                    @endif
                </div>

            </div>
            <div class="w-full md:w-3/5">
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

            </div>
        </div>


    </x-custom-form>


</x-app-layout>

<script>
    function previewImage(event) {
        // Get the file input element
        const input = event.target;

        // Check if a file was selected
        if (input.files && input.files[0]) {
            // Create a file reader object
            const reader = new FileReader();

            // Set the onload callback function
            reader.onload = function(e) {
                // Get the preview image element
                const preview = document.getElementById('advertisementImagePreview');

                // Set the source of the preview image element to the data URL
                preview.src = e.target.result;

                // Show the preview image element
                preview.classList.remove('hidden');
            };

            // Read the file data as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
