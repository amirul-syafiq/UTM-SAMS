
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="h-64 bg-gray-400"
        style="background-image: url('{{ $event->eventAdvertisementImage->image_s3_key }}'); background-size: cover; background-position: center;">
    </div>
    <div class="p-4">
@php
@endphp
        <h3 class="font-semibold text-lg mb-2">{{ $event->event->event_name }}</h3>
        <div class="text-gray-600 text-sm mb-2">{{ \Carbon\Carbon::parse($event->event->event_start_date)->toDayDateTimeString() }}</div>
        <div class="text-gray-600 text-sm mb-2">{{ $event->event->event_venue }}</div>
        <p class="text-gray-700 text-sm">{{ $event->promotion_description }}</p>
        <p> tags:
             @foreach ($event->tags as $tag)
            <span class="text-gray-700 text-sm">#{{ $tag->tag_name }}, </span>
        @endforeach</p>
    </div>

    {{ $slot }}
</div>
