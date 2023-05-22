<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('dashboard.search') }}" class="mb-2">
                <label for="event_search_keyword"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" name="event_search_keyword" id="event_search_keyword"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Enter search keyword" value="{{ old('event_search_keyword') }}">
                    <button type="submit"
                        class="text-sm px-4 py-2 absolute right-2.5 bottom-2.5 bg-primary hover:bg-accent-2 hover:text-secondary text-white font-bold  rounded-md">Search</button>
                </div>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($events as $event)
                    <a href="{{ route('event-advertisement.view', ['eventAdvertisement_id' => $event->id]) }}"
                        class="hover:scale-105">
                        <x-custom-event-card :event="$event">
                        </x-custom-event-card>
                    </a>
                @endforeach
            </div>

            <br>
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
