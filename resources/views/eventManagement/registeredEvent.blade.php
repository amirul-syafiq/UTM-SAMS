<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Event Registration History
        </h2>
    </x-slot>
    <x-custom-container-alt>
        <div class=" bg-white overflow-auto shadow-xl sm:rounded-lg">
            <table class="table-auto w-full text-center">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-22">Registration Date</th>
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
                            <td class="text-left border px-4 py-2">
                                <button type="button"
                                    onclick="location.href='{{ route('event-advertisement.view', $registeredEvent->event_advertisement_id) }}'"
                                    class="bg-primary-bg hover:bg-accent-2 hover:text-black text-white font-bold mt-1 py-1 px-2 rounded min-w-full">
                                    View Detail
                                </button>

                                {{-- Check if ecert is set avalaible --}}

                                @if ($registeredEvent->ecertificate_status == 'EC02' && $registeredEvent->status_code == 'PR02')
                                    <div class="min-w-[8rem]">
                                        <button type="button"
                                            class="bg-[#104554] hover:bg-accent-2 hover:text-black text-white font-bold mt-1 py-1 px-2 rounded min-w-full">
                                            <a href="{{ route('ecert.generate', $registeredEvent->event_advertisement_id) }}"
                                                target="_blank">
                                                View E-Certificate
                                            </a>
                                        </button>
                                    </div>
                                @else
                                    <div class="min-w-[8rem]">
                                        <button type="button" title="Certificate Not available to download"
                                            class="opacity-70 bg-secondary text-white font-bold mt-1 py-1 px-2 rounded pointer-events-none min-w-full"
                                            disabled>E-Certificate Not Available</button>
                                    </div>
                                @endif

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
