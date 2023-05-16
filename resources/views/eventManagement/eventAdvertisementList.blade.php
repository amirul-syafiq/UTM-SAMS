<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Event Advertisement List
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($eventAdvertisements->isEmpty())
                <div class="text-center">
                    <h1 class="text-2xl dark:text-white">No Event Advertisement Found</h1>
                    <br>
                    <a href="{{ route('event-advertisement.create', $event_id) }}"
                        class="bg-primary hover:bg-accent-2 hover:text-secondary text-white font-bold py-2  px-4 rounded-md">Create
                        New Event Advertisement</a>
                </div>
            @else
                <div class="mb-5 text-right">
                    <a href="{{ route('event-advertisement.create', $event_id) }}"
                        class="bg-primary hover:bg-accent-2 hover:text-secondary text-white font-bold py-2  px-4 rounded-md">Create
                        New Event Advertisement</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($eventAdvertisements as $eventAdvertisement)
                        <x-custom-event-card :event="$eventAdvertisement">
                            <div class=" text-right p-3">
                                <a href="{{ route('event-advertisement.edit', ['clubEventId' => $event_id,'eventAdvertisementId'=>$eventAdvertisement->id]) }}"
                                    class="bg-accent-1 hover:bg-accent-3 hover:text-secondary text-white font-bold py-2 px-4 rounded">Edit</a>

                            </div>
                        </x-custom-event-card>
                    @endforeach
                </div>

            @endif

        </div>


    </div>
</x-app-layout>
