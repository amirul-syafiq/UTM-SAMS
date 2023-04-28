<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($events as $event)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-64 bg-gray-400" style="background-image: url('{{ $event->eventImage->image_s3_key }}'); background-size: cover; background-position: center;"></div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $event->event->event_name }}</h3>
                        <div class="text-gray-600 text-sm mb-2">{{ $event->event->event_start_date }}</div>
                        <div class="text-gray-600 text-sm mb-2">{{ $event->event->event_venue }}</div>
                        <p class="text-gray-700 text-sm">{{ $event->event->event_description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>
</x-app-layout>