<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

            {{ $clubEvent->event_name }}
            @if (isset($eventAdvertisement))
                {{ __(' > Edit Advertisement') }}
            @else
                {{ __('> Create New Advertisement') }}
            @endif
        </h2>
    </x-slot>

    <x-custom-form method="{{ $formAction['method'] ?? 'POST' }}" title="Please fill in all the detail"
            action="{{ route(
            $formAction['route'] ?? 'event-advertisement.store',
            isset($eventAdvertisement)
                ? ['eventAdvertisementId' => $eventAdvertisement->id,'clubEventId' =>$clubEvent->id] //if there is clubEvent, then pass the id to the route else pass empty array
                : ['clubEventId' =>$clubEvent->id],
        ) }}" >

        <x-validation-errors class="mb-4" />
        <div id="advertisementDetailSection">

            <div class="flex flex-col md:flex-row">
                <!-- First Column -->
                <div class="w-full md:w-2/5 md:pr-4">
                    <div class="mb-2">
                        <x-label for="advertisementImage" value="{{ __('Upload Image') }}" />
                        <input type="file" name="advertisementImage" id="advertisementImage" onchange="previewImage(event)" accept="image/png, image/gif, image/jpeg">
                        <span class="text-red-500 text-sm"></span>
                    </div>
                    <div class="mb-2">
                        <!-- Check for existing image if available in database -->
                        @if(isset($eventAdvertisement) && isset($eventAdvertisement->eventAdvertisementImage))
                            <img id="advertisementImagePreview" src="{{ $eventAdvertisement->eventAdvertisementImage->imageUrl ? $eventAdvertisement->eventAdvertisementImage->imageUrl : '#' }}" alt="Advertisement Image Preview" class="w-3/4 {{ $eventAdvertisement->eventAdvertisementImage->imageUrl ? '' : 'hidden' }}">
                        @else
                            <img id="advertisementImagePreview" src="#" alt="Advertisement Image Preview" class="w-3/4 hidden">
                        @endif
                    </div>

                </div>
                <!-- Second column -->
                <div class="w-full md:w-3/5">
                    <div class="mb-2">
                        <x-label for="advertisementTitle" value="{{ __('Advertisement Title') }}" />
                        <x-custom-input id="advertisementTitle" class="block mt-1 w-full" type="text" name="advertisementTitle"
                            :value="$eventAdvertisement->advertisement_title ?? ''" required autofocus
                            autocomplete="Advertisement Title" placeholder="Enter title for your advertisement"/>
                        <span class="text-red-500 text-sm"></span>
                    </div>

                    <div class="mb-2">
                        <x-label for="advertisementDescription" value="{{ __('Advertisement Description') }}" />
                        <x-custom-textarea name="advertisementDescription" placeholder="Enter advertisement description" required>{{ $eventAdvertisement->advertisement_description ?? '' }}</x-textarea>
                        <span class="text-red-500 text-sm"></span>
                    </div>

                    <div class="mb-2">
                        <x-label for="advertisementStartDate" value="{{ __('Advertisement Start Date') }}" />
                        <x-custom-input id="advertisementStartDate" class="block mt-1 w-full" type="date"
                            name="advertisementStartDate" :value="isset($eventAdvertisement)
                                ? $eventAdvertisement->advertisement_start_date
                                : ''" required autofocus
                            autocomplete="Advertisement Start Date" />
                        <span class="text-red-500 text-sm"></span>
                    </div>

                    <div class="mb-2">
                        <x-label for="advertisementEndDate" value="{{ __('Advertisement End Date') }}" />
                        <x-custom-input id="advertisementEndDate" class="block mt-1 w-full" type="date"
                            name="advertisementEndDate" :value="isset($eventAdvertisement)
                                ? $eventAdvertisement->advertisement_end_date
                                : ''" required autofocus
                            autocomplete="Advertisement End Date" />
                        <span class="text-red-500 text-sm"></span>
                    </div>
                    <div class="mb-2">
                        <x-label for="participantLimit" value="{{ __('Participant Limit') }}" />
                        <x-custom-input id="participantLimit" class="block mt-1 w-full" type="number"
                            name="participantLimit" :value="$eventAdvertisement->participant_limit ??''" required autofocus
                            autocomplete=10  />
                        <span class="text-red-500 text-sm"></span>
                    </div>
                    <div class="mb-2">
                        <x-label for="advertisementTags" value="{{ __('Tags') }}" />
                        {{-- Space cannot be added for text area to avoid any extra space in the field later --}}

                        <x-custom-textarea name="advertisementTags" placeholder="Add your tags here" required>@if (!empty($eventAdvertisement))@foreach ($eventAdvertisement->tags as $tag){{ $tag->tag_name }}@if (!$loop->last),@endif @endforeach @endif </x-custom-textarea>
                        <span class="text-red-500 text-sm"></span>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-button type="button" id="nextButton" name="nextButton" onclick="navigatePage()">{{ __('Next') }}</x-button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Participant form section -->
        <div id="participantSection" class="dark:text-white px-5" hidden>
            <p> The following data will be collected from the user upon their registration. The data cannot be changed.</p>
            <ul class="list-disc">
                <li>Full Name</li>
                <li>NRIC/ Passport Number</li>
                <li>Matric Id</li>
                <li>Phone Number</li>
                <li>Address</li>
                <li>Email</li>
               {{-- Display additional information that has been inserted --}}
                @if (isset($eventAdvertisement) && !empty($eventAdvertisement->additional_informations))

                    @foreach ($eventAdvertisement->additional_informations as $additional_information)
                    <li>{{ Str::title(Str::of($additional_information)->snake()->replace('_', ' ') ) }}</li>
                    @endforeach
                @endif
            </ul>
            <br>
            {{-- Not allow additional information to be updated when the event advertisement is created --}}
            @if (!(isset($eventAdvertisement)))
            <p> To request additional information please specify below:</p>
            <p><i>Note: You cannot modify this section after submit</i></p>
            <input type="number" hidden id="inputCounter" name="inputCounter" value=-1>
            <button type="button" onclick="addParticipantField()" class="bg-secondary hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">Add Field</button>
            @endif
            <div id="newInput"></div>

            <x-slot name="actions" >
                <div class="flex mt-4">
                    <div class="justify-start">
                        <x-button type="button" id="previousButton" name="previousButton" onclick="navigatePage()">{{ __('Previous') }}</x-button>
                    </div>

                    <div class="ml-auto">
                        <button type="submit" id="submitButton" name="submitButton" class="bg-primary hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">{{ __('Submit') }}<button>
                    </div>

                </div>
            </x-slot>


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
    let inputCounter = -1;


    function addParticipantField() {

        inputCounter++;
         // Update the hidden input field
         const inputCounterField = document.getElementById('inputCounter');
        inputCounterField.value = inputCounter;

        // Get the participant section element
        const participantSection = document.getElementById('newInput');

        // Create a new field container div
        const fieldContainer = document.createElement('div');
        fieldContainer.classList.add('field-container');

        // Create a new input element
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.id = `additionalInformation${inputCounter}`;
        newInput.name = `additionalInformation${inputCounter}`;
        // Not allow comma to be inserted
        newInput.pattern = "^[^,]*$";
        newInput.title = "Comma is not allowed";
        newInput.placeholder = 'Enter additional information to be collected from the user';
        newInput.classList.add('border-gray-300', 'dark:border-gray-700', 'dark:bg-gray-900', 'dark:text-gray-300', 'focus:border-indigo-500', 'dark:focus:border-indigo-600', 'focus:ring-indigo-500', 'dark:focus:ring-indigo-600', 'rounded-md', 'shadow-sm', 'block', 'mt-1', 'w-full');
        newInput.classList.add('input-field');

        // Create a remove button
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.textContent = 'Remove';
        removeButton.classList.add('bg-red-500', 'text-white', 'py-2', 'px-4', 'rounded', 'mt-2');
        removeButton.addEventListener('click', () => removeParticipantField(fieldContainer));

        // Append the input and remove button to the field container div
        fieldContainer.appendChild(newInput);
        fieldContainer.appendChild(removeButton);

        // Append the field container to the participant section element
        participantSection.appendChild(fieldContainer);

    }

    function removeParticipantField(fieldContainer) {
        // Get the parent element of the field container
        const parentElement = fieldContainer.parentNode;

        // Remove the field container from the parent element
        parentElement.removeChild(fieldContainer);

        // Update the index of the remaining input fields
        const inputFields = parentElement.querySelectorAll('.input-field');
        inputFields.forEach((input, index) => {
            input.name = `additionalInformation${index}`;
            input.id = `additionalInformation${index}`;
        });
        inputCounter--;
        // Update the hidden input field
        const inputCounterField = document.getElementById('inputCounter');
        inputCounterField.value = inputCounter;
    }



function navigatePage() {
    // Get the participant section element
    const participantSection = document.getElementById('participantSection');
    const advertisementDetailSection = document.getElementById('advertisementDetailSection');

    // Check if the participant section is hidden
    if (participantSection.hidden) {
        // Perform validation on required fields before navigating to the next page
        const requiredFields = document.querySelectorAll('[required]');
        const missingFields = [];

        requiredFields.forEach(field => {
            if (field.value.trim() === '') {
                missingFields.push(field);
                field.nextElementSibling.textContent = 'This field is required.'; // Set error message
            } else {
                field.nextElementSibling.textContent = ''; // Clear error message
            }
        });

        if (missingFields.length > 0) {
            // Prevent navigation if there are missing fields
            return;
        }

        // Show the participant section
        participantSection.hidden = false;
        advertisementDetailSection.hidden = true;
    } else {
        // Hide the participant section
        participantSection.hidden = true;
        advertisementDetailSection.hidden = false;
    }
}


</script>
