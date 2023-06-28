<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('E-Certificate') }}
        </h2>
    </x-slot>

    <x-custom-form method="POST" title="Upload E-Certificate"
        action="{{ route('ecert.store', ['eventAdvertisementId' => $event_advertisement_id]) }}">
        <x-validation-errors class="mb-4" />

        <div class="flex flex-col md:flex-row">
            {{-- First Column to upload and display image --}}
            <div class="w-full md:w-2/5 md:pr-4">
                {{-- Button for user to use template provided --}}
                <div class="mb-2">
                    <a href="{{ route('ecert.useTemplate', ['eventAdvertisementId' => $event_advertisement_id]) }}"
                        class="bg-secondary hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">Use
                        Template</a>
                </div>
                <div class="mb-2">
                    <x-label for="ecertSVG" value="{{ __('Upload Image') }}" />
                    <input type="file" name="ecertSVG" id="ecertSVG" onchange="previewImage(event)"
                        accept="image/svg+xml">
                    <span class="text-red-500 text-sm"></span>
                </div>
                <div class="mb-2">
                    <!-- Check for existing image if available in database -->
                    @if (isset($ecertSVG) && isset($ecertSVG->ecertificate_s3_key))
                        <img id="ecertSVGPreview" src="{{ $ecertSVG->imageUrl ? $ecertSVG->imageUrl : '#' }}"
                            alt="Advertisement Image Preview" class="w-3/4 {{ $ecertSVG->imageUrl ? '' : 'hidden' }}">
                    @else
                        <img id="ecertSVGPreview" src="#" alt="Advertisement Image Preview" class="w-3/4 hidden">
                    @endif
                </div>
            </div>

            {{-- Second column to set ecert details --}}
            <div class="w-full md:w-3/5">
                {{-- Set e certificate is available to be download by user --}}
                <div class="mb-2">
                    <x-custom-dropdown name="ecertStatus" :options="$ecertStatusList" :selected="$ecertSVG->ecertificate_status ?? 'old(ecertStatusList)'"
                        label="Ecertificate Status" />
                </div>

            </div>
        </div>
    </x-custom-form>
</x-app-layout>

<script>
    let inputCounter = 0;

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
                const preview = document.getElementById('ecertSVGPreview');

                // Set the source of the preview image element to the data URL
                preview.src = e.target.result;

                // Show the preview image element
                preview.classList.remove('hidden');
            };

            // Read the file data as a data URL
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addECertDataField() {
        inputCounter++;
        // Update the hidden input field
        const inputCounterField = document.getElementById('inputCounter');
        inputCounterField.value = inputCounter;

        // Get the container element
        const container = document.getElementById('ecertDataField');

        // Create a new div element
        const fieldContainer = document.createElement('div');
        fieldContainer.classList.add('flex', 'flex-col', 'md:flex-row', 'mb-2');

        // Create a new input element
        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.id = `additionalInformation${inputCounter}`;
        newInput.name = `additionalInformation${inputCounter}`;

        // Input must not contain space or special characters
        newInput.pattern = '^[a-zA-Z0-9_]*$';
        newInput.required = true;
        newInput.placeholder = 'Ecertificate Field Name';
        newInput.classList.add('border-gray-300', 'dark:border-gray-700', 'dark:bg-gray-900', 'dark:text-gray-300',
            'focus:border-indigo-500', 'dark:focus:border-indigo-600', 'focus:ring-indigo-500',
            'dark:focus:ring-indigo-600', 'rounded-md', 'shadow-sm', 'block', 'mt-1', 'w-full');
        newInput.classList.add('input-field');
        newInput.title = 'Enter field name as defined in the file. Name must not contain space or special characters';

        fieldContainer.appendChild(newInput);
        container.appendChild(fieldContainer);

    }


</script>
