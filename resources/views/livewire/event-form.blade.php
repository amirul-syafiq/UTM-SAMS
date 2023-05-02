<div>
    <x-form-section submit="createEvent">

        <x-slot name="title">{{ __('Create Event') }}</x-slot>
        <x-slot name="description">{{ __('Please fill out all event details') }}</x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Event Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="eventName" autocomplete="name"  required/>
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="description" value="{{ __('Event Description') }}" />
                <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="eventDescription" autocomplete="description" required />
                <x-input-error for="description" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="eventRefNo" value="{{ __('Event Reference Number') }}" />
                <x-input id="eventRefNo" type="text" class="mt-1 block w-full" wire:model.defer="eventRefNo" autocomplete="event reference no" required />
                <x-input-error for="eventRefNo" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="eventType" value="{{ __('Event Type') }}" />
                <x-input id="eventType" type="text" class="mt-1 block w-full" wire:model.defer="eventType" autocomplete="event reference no" required />
                <x-custom-dropdown name="role" :options="[1,2]" selected="old(role)" label="User Role" />

                <x-input-error for="eventType" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="venue" value="{{ __('Venue') }}" />
                <x-input id="venue" type="text" class="mt-1 block w-full" wire:model.defer="eventVenue" autocomplete="Venue" required />
                <x-input-error for="venue" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="startDateTime" value="{{ __('Start Date and Time') }}" />
                <x-input id="startDateTime" type="datetime-local" class="mt-1 block w-full" wire:model.defer="eventStartDateTime" required/>
                <x-input-error for="startDateTime" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="endDateTime" value="{{ __('End Date and Time') }}" />
                <x-input id="endDateTime" type="datetime-local" class="mt-1 block w-full" wire:model.defer="eventEndDateTime" required/>
                <x-input-error for="endDateTime" class="mt-2" />
            </div>
            <x-slot name="actions">
                <x-button type="submit">{{ __('Create') }}</x-button>
            </x-slot>

        </x-slot>

    </x-form-section>
</div>
