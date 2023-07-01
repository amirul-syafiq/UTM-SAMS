<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semipt-1y-800 dark:text-gray-200 leading-tight">
            {{ $eventAdvertisement->advertisement_title }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap md:mx-20">
        <div class="w-full md:w-1/2 p-10 ">
            <!-- Left row for displaying the image -->
            <img src="{{ $eventAdvertisement->eventAdvertisementImage->imageUrl }}" alt="Image"
                class="aspect-w-4 aspect-h-3">
        </div>

        <div class="w-full md:w-1/2 overflow-auto">
            <x-custom-container>
                <x-label>{{ __('Description') }}</x-label>
                <br>

                <span
                    class="whitespace-pre-line text-md mx-2 p-2">{{ $eventAdvertisement->advertisement_description }}</span>

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
                        <span class="whitespace-pre-line">{{ $eventAdvertisement->Event->event_description }}</span>
                    </div>

                    <div>
                        <x-label>{{ __('Event Venue') }}</x-label>
                    </div>
                    <div>
                        <p>{{ $eventAdvertisement->Event->event_venue }}</p>
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
                    <input type="hidden" id="eventOrganizer"
                        value="{{ $eventAdvertisement->Event->event_organizer }}">

                </div>
                {{-- Check if user is participant or staff --}}
                    @if (Auth::user()->role_code=='UR03'||Auth::user()->role_code=='UR02')
                {{-- Display buttons --}}
                    <div class="mt-8 text-center">
                        <a href="" onclick="onClick()"
                            class="bg-green-500 hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">Chat</a>
                        @if (!$isRegistered && !$isFull)
                            <a href="{{ route('participant.create', ['event_id' => $eventAdvertisement->id]) }}"
                                class="bg-primary hover:bg-accent-2 hover:text-black text-white font-bold py-2  px-4 rounded">Register
                                Now</a>
                        @elseif($isRegistered)
                            <button disabled
                                class="opacity-75 bg-secondary  text-white font-bold py-2  px-4 rounded">Already
                                Register</button>
                        @elseif($isFull)
                            <button disabled class=" bg-secondary  text-white font-bold py-2  px-4 rounded">Registration
                                Full</button>
                        @elseif($isClose)
                            <button disabled class=" bg-secondary  text-white font-bold py-2  px-4 rounded">Registration is
                                closed</button>
                        @endif
                    </div>
                    @endif


            </x-custom-container>
        </div>
    </div>
</x-app-layout>



<script>
    function onClick() {
        event.preventDefault();
        var UID = document.getElementById('eventOrganizer').value;


        CometChatWidget.chatWithUser(UID);
        CometChatWidget.openOrCloseChat(true);
        console.log("clicked");

    }
</script>
