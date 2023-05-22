<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $eventAdvertisement->advertisement_title }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap mx-20">
        <div class="w-full sm:w-1/2 p-3 ">
            <!-- Left row for displaying the image -->
            <img src="{{ $eventAdvertisement->eventAdvertisementImage->imageUrl }}" alt="Image" class="aspect-w-4 aspect-h-3">
        </div>
        <div class="w-full sm:w-1/2">
          <x-custom-container>
aa
          </x-custom-container>
        </div>
    </div>


</x-app-layout>
