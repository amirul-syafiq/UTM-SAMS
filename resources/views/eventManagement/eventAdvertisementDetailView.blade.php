<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semipt-1y-800 dark:text-gray-200 leading-tight">
            {{ $eventAdvertisement->advertisement_title }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap mx-20">
        <div class="w-full sm:w-1/2 p-3 ">
            <!-- Left row for displaying the image -->
            <img src="{{ $eventAdvertisement->eventAdvertisementImage->imageUrl }}" alt="Image"
                class="aspect-w-4 aspect-h-3">
        </div>
        <div class="w-full sm:w-1/2 overflow-auto">
            <x-custom-container>
                <x-label>{{ __('Description') }}</x-label>
                <p class=" text-lg mx-2 p-2">{{ $eventAdvertisement->advertisement_description }}</p>

                <br><br>
                <h4>{{ __('About Event') }}</h4>
                <div class="grid grid-cols 1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label cl>{{ __('Event Name') }}</x-label>
                    </div>
                    <div>
                        <p>{{ $eventAdvertisement->Event->event_name }}</p>
                    </div>

                    <div>
                        <x-label>{{ __('Event Description') }}</x-label>
                    </div>
                    <div>
                        <p>{{ $eventAdvertisement->Event->event_description }}</p>
                    </div>

                    <div>
                        <x-label>{{ __('Event Start Date and Time') }}</x-label>
                    </div>
                    <div>
                        <p>{{ date('l d/m/Y H:i A', strtotime($eventAdvertisement->Event->event_start_date)) }}</p>
                    </div>

                    <div>
                        <x-label>{{ __('Event End Date and Time') }}</x-label>
                    </div>
                    <div>
                        <p> {{ date('l d/m/Y H:i A', strtotime($eventAdvertisement->Event->event_end_date)) }}</p>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <a href=""
                        class= "bg-primary hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">Register Now</a>
                </div>


            </x-custom-container>
        </div>
    </div>


</x-app-layout>
