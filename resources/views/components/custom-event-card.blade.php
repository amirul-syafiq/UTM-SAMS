<!--This code snippet represents a container for displaying an event advertisement.
    It consists of an image section and a details section. -->

<div class="bg-white rounded-lg shadow-lg overflow-hidden h-128">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Image section -->
        <div class="h-64 relative" name="imageDiv">
            {{-- Blurred background image --}}
            <div class="absolute inset-0">
                <img src="{{ $event->eventAdvertisementImage->imageUrl }}" alt="Image"
                    class="h-full w-full object-cover bg-white blur-sm">
            </div>
            {{-- Image --}}
            <div class="absolute inset-1 flex items-center justify-center">
                <img src="{{ $event->eventAdvertisementImage->imageUrl }}" alt="Image"
                    class="max-h-full max-w-full object-contain">
            </div>
        </div>
    </div>

    <!-- Details section -->
    <div class="p-4 h-64" name="detailDiv">
        <h3 class="font-semibold text-lg mb-2">{{ $event->advertisement_title }}</h3>
        <h4 class="font-semibold text-lg mb-2">{{ $event->event->event_name }}</h4>
        <div class="text-gray-600 text-sm mb-2">
            {{ \Carbon\Carbon::parse($event->event->event_start_date)->toDayDateTimeString() }}
        </div>
        <p class="text-gray-700 text-sm">
            {{-- Limit the text to 200 characters --}}
            {{ Str::limit($event->advertisement_description, 200, ' ...') }}
        </p>
        <br>
    </div>
    <div class="align-text-bottom ">
        {{ $slot }}
    </div>
</div>
