<div class="bg-white rounded-lg shadow-lg overflow-hidden h-128">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="h-64 relative" name="imageDiv">
            <div class="absolute inset-0">
                <img src="{{ $event->eventAdvertisementImage->imageUrl }}" alt="Image"
                    class="h-full w-full object-cover bg-white blur-sm	">
            </div>
            <div class="absolute inset-1 flex items-center justify-center">
                <img src="{{ $event->eventAdvertisementImage->imageUrl }}" alt="Image"
                    class="max-h-full max-w-full object-contain">
            </div>
        </div>
    </div>



    <div class="p-4 h-64" name="detailDiv" >
        <h3 class="font-semibold text-lg mb-2">{{ $event->advertisement_title }}</h3>
        <h4 class="font-semibold text-lg mb-2">{{ $event->event->event_name }}</h4>
        <div class="text-gray-600 text-sm mb-2">
            {{ \Carbon\Carbon::parse($event->event->event_start_date)->toDayDateTimeString() }}
        </div>
        <p class="text-gray-700 text-sm">{{ Str::limit($event->advertisement_description, 200, ' ...') }}</p>
        <br>
        {{-- <p>
            tags:
            @foreach ($event->tags as $tag)
                <span class="text-gray-700 text-sm">#{{ $tag->tag_name }}</span>
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        </p> --}}
    </div>
    <div class="align-text-bottom ">
        {{ $slot }}
    </div>
</div>
