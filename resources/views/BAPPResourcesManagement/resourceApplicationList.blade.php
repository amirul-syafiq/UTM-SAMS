<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Resource Application List
        </h2>
    </x-slot>
    <x-custom-container-alt>
        <div class=" bg-white overflow-auto shadow-xl sm:rounded-lg">
            <table class="table-auto w-full text-center">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-22">Application Date</th>
                        <th class="px-4 py-2">Registration Name</th>
                        <th class="px-4 py-2">Registration Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>

                    @foreach ($registeredEvents as $registeredEvent)
                        <tr>
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 ">
                                {{ date(' d/m/Y', strtotime($registeredEvent->register_date)) }}
                            </td>
                            <td class="border px-4 py-2">{{ $registeredEvent->advertisement_title }}</td>
                            <td class="border px-4 py-2">{{ $registeredEvent->status_name }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('event-advertisement.view',$registeredEvent->event_advertisement_id) }}"
                                    class="bg-primary-bg hover:bg-accent-2 hover:text-black text-white font-bold mt-1 py-1 px-2 rounded">View Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
            <div class="p-2">
                {{ $registeredEvents->links() }}
            </div>
        </div>
    </x-custom-container-alt>

</x-app-layout>
