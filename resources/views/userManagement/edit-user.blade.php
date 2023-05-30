<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <x-custom-form method="PUT" title="User Details"
        action="{{ route('admin.updateUser', ['user_id' => $user->id]) }}" buttonText="Update">

        <x-validation-errors class="mb-4" />
        <x-label>{{ __('Name') }}</x-label>
        <x-custom-input required class="mt-1 w-full" type="text" name="user_name" :value="$user->name" />

        <x-label>{{ __('UTM ID') }}</x-label>
        <x-custom-input required class="mt-1 w-full" type="text" name="user_utm_id" :value="$user->utm_id" />

        <x-label>{{ __('Email') }}</x-label>
        <x-custom-input required class="mt-1 w-full" type="text" name="email" :value="$user->email" />

        <x-label>{{ __('Address') }}</x-label>
        <x-custom-input required class="mt-1 w-full" type="text" name="user_address" :value="$user->address" />

        <x-label>{{ __('Phone Number') }}</x-label>
        <x-custom-input required class="mt-1 w-full" type="text" name="user_phone" :value="$user->phone" />

        <x-label>{{ __('Role') }}</x-label>
        <div class="mt-4">
            <x-custom-dropdown name="user_role" :options="$roles" :selected=" $user->role_code " label="User Role" />
        </div>

    </x-custom-form>
</x-app-layout>
