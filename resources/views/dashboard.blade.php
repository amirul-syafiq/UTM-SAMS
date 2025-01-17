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

                {{-- NEW ONE --}}
                {{-- <div class="relative mb-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                <div class="flex items-center space-x-2 ">
                    <input type="search" name="event_search_keyword" id="event_search_keyword"
                        class="inline-block w-2/4 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search User Name" value=" {{ isset($keyword) ? $keyword : '' }}">
                    <svg data-dropdown-toggle="dropdownAction" fill="none" class="text-black dark:text-white w-8"
                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75">
                        </path>
                    </svg>
                    <div id="dropdownAction"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownActionButton">


                        </ul>
                    </div>

                    <button type="submit"
                        class="inline-block text-sm px-4 mt-2 py-2 bg-primary hover:bg-accent-2 hover:text-secondary text-white font-bold rounded-md">Search</button>
                </div>
                </div> --}}
                {{-- END HERE --}}
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


@auth
<script src="{{ asset('js/enable-push.js') }}" defer></script>

@endauth

</x-app-layout>
