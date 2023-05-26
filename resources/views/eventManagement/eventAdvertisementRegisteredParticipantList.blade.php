<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Participant List') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white overflow-auto shadow-xl sm:rounded-lg mt-5">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone Number</th>
                        @foreach ($eventAdvertisement->additional_informations as $additional_information)
                            <th class="px-4 py-2">{{ $additional_information }}</th>
                        @endforeach
                        <th class="px-4 py-2">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $index=($participants->currentPage()-1)*$participants->perPage();
                    @endphp
                    @foreach ($participants as $participant)
                        <tr>
                            <td class="border px-4 py-2">{{$index +$loop->iteration }}</td>
                            <td class="border px-4 py-2" name="{{ 'participant_name' .$loop->iteration }}">
                                {{ $participant->user->name }}</td>
                            <td class="border px-4 py-2" name="{{ 'participant_email' . $loop->iteration }}">
                                {{ $participant->user->email }}</td>
                            <td class="border px-4 py-2" name="{{ 'participant_phone' . $loop->iteration }}">
                                {{ $participant->user->phone }}</td>
                            @foreach ($eventAdvertisement->additional_informations as $additional_information)
                                <td class="border px-4 py-2" name="{{ $additional_information . $loop->iteration }}">
                                    {{ $participant->additional_information->{$additional_information} }}</td>
                            @endforeach
                            <td class="border px-4 py-2 text-center">
                                <div hidden id="{{ 'editableStatusDiv' . $loop->iteration }}">
                                    <form method="POST"
                                        action="{{ route('participant.updateParticipantStatus', [$eventAdvertisement->id, $participant->id]) }}"
                                        id="participantForm{{ $loop->iteration }}">
                                        @method('PUT')
                                        @csrf
                                        <x-custom-dropdown class="rounded-md shadow-sm block mt-1 w-full	"
                                            name="{{ 'participant_registration_status' . $loop->iteration }}"
                                            :options="$registrationStatuses" :selected="$participant->registration_status" label="" />
                                        <input hidden name="iteration" type="text" value="{{ $loop->iteration }}">
                                        <button type="button" onclick="cancelEdit({{ $loop->iteration }})"
                                            class="bg-secondary hover:bg-accent-2 hover:text-black text-white font-bold mt-2  px-2 rounded"
                                            id="cancelButton" name="cancelButton">{{ __('Cancel') }}</button>
                                        <button type="submit"
                                            class="bg-primary hover:bg-accent-2 hover:text-black text-white font-bold mt-2  px-2 rounded"
                                            id="submitButton" name="submitButton">{{ __('Save') }}</button>
                                    </form>


                                </div>

                                <div id="{{ 'viewStatusDiv' . $loop->iteration }}">
                                    <span id="{{ 'view_status' . $loop->iteration }}"></span>
                                    <svg class="text-tertiary"onclick='openEditable( {{ $loop->iteration }}) 'style="width: 2em; height: 1.5em; display: inline;"
                                        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <title>Edit</title>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                        </path>
                                    </svg>
                                </div>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           <div class="p-2">
            {{ $participants->links() }}
           </div>
        </div>
    </div>

</x-app-layout>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($participants as $participant)
            // Get the registration status dropdown element
            var registrationStatusDropdown{{ $loop->iteration }} = document.querySelector(
                '[name="{{ 'participant_registration_status' . $loop->iteration }}"]');

            // Get the selected option in the dropdown
            var selectedOption{{ $loop->iteration }} = registrationStatusDropdown{{ $loop->iteration }}
                .options[registrationStatusDropdown{{ $loop->iteration }}.selectedIndex];

            // Get the value and label of the selected option
            var registrationStatusValue{{ $loop->iteration }} = selectedOption{{ $loop->iteration }}.value;
            var registrationStatusLabel{{ $loop->iteration }} = selectedOption{{ $loop->iteration }}
                .textContent;

            // Set the value and label in the view_status span
            document.querySelector('#view_status{{ $loop->iteration }}').textContent =
                registrationStatusLabel{{ $loop->iteration }};

            // Update the view_status span when the registration status dropdown changes
            registrationStatusDropdown{{ $loop->iteration }}.addEventListener('change', function() {
                // Store the previous value in a data attribute of the dropdown
                this.setAttribute('data-previous-value',
                registrationStatusValue{{ $loop->iteration }});

                var newSelectedOption{{ $loop->iteration }} = this.options[this.selectedIndex];
                var newRegistrationStatusValue{{ $loop->iteration }} =
                    newSelectedOption{{ $loop->iteration }}.value;
                var newRegistrationStatusLabel{{ $loop->iteration }} =
                    newSelectedOption{{ $loop->iteration }}.textContent;
                document.querySelector('#view_status{{ $loop->iteration }}').textContent =
                    newRegistrationStatusLabel{{ $loop->iteration }};
            });
        @endforeach


    });

    function openEditable(loop_iteration) {
        var editableStatusDiv = document.getElementById("editableStatusDiv" + loop_iteration);
        var viewStatusDiv = document.getElementById("viewStatusDiv" + loop_iteration);

        editableStatusDiv.style.display = "block";
        viewStatusDiv.style.display = "none";

        // Close other divs
        var allEditableDivs = document.querySelectorAll("[id^=editableStatusDiv]");
        var allViewDivs = document.querySelectorAll("[id^=viewStatusDiv]");

        for (var i = 0; i < allEditableDivs.length; i++) {
            var editableDiv = allEditableDivs[i];
            var viewDiv = allViewDivs[i];

            if (editableDiv.id !== "editableStatusDiv" + loop_iteration) {
                editableDiv.style.display = "none";
                viewDiv.style.display = "block";
            }
        }
    }

    function cancelEdit(loop_iteration) {
        var editableStatusDiv = document.getElementById("editableStatusDiv" + loop_iteration);
        var viewStatusDiv = document.getElementById("viewStatusDiv" + loop_iteration);

        editableStatusDiv.style.display = "none";
        viewStatusDiv.style.display = "block";

        // Reset the selected option in the registration status dropdown
        var registrationStatusDropdown = document.querySelector('[name="participant_registration_status' +
            loop_iteration + '"]');
        var previousValue = registrationStatusDropdown.getAttribute('data-previous-value');

        if (previousValue !== null) {
            registrationStatusDropdown.value = previousValue;

            // Update the view_status span with the previous label
            var previousLabel = registrationStatusDropdown.options[registrationStatusDropdown.selectedIndex]
            .textContent;
            document.querySelector('#view_status' + loop_iteration).textContent = previousLabel;
        }
    }
</script>
