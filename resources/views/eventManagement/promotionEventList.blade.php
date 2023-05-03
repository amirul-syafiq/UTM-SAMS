<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Event Promotion List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($eventPromotions as $eventPromotion )

                <x-custom-event-card :event="$eventPromotion">
                    <div class="text-right p-3">

                            <a href="{{ route('event-promotion.viewMyEventPromotion',['event_id'=>$eventPromotion->id]) }}"
                                class= "bg-primary hover:bg-accent-1 hover:text-secondary text-white font-bold py-2 px-4 rounded">Edit</a>


                    </div>
                </x-custom-table>
                @endforeach
            </div>
        </div>


    </div>
</x-app-layout>
