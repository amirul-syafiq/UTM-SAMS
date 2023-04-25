<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg justify-content " style="display:flex ;flex-wrap:wrap">
                @include('dashboard.event-card', [
                'title' => 'Event Title',
                'date' => '2023-05-01',
                'location' => 'Online',
                'image' => 'https://via.placeholder.com/800x400.png?text=Event+Image',
                'class' => 'my-event-card',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem.'
                ])
                @include('dashboard.event-card', [
                'title' => 'Event Title',
                'date' => '2023-05-01',
                'location' => 'Online',
                'image' => 'https://via.placeholder.com/800x400.png?text=Event+Image',
                'class' => 'my-event-card',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem.'
                ])
                @include('dashboard.event-card', [
                'title' => 'Event Title',
                'date' => '2023-05-01',
                'location' => 'Online',
                'image' => 'https://via.placeholder.com/800x400.png?text=Event+Image',
                'class' => 'my-event-card',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem.'
                ])
                @include('dashboard.event-card', [
                'title' => 'Event Title',
                'date' => '2023-05-01',
                'location' => 'Online',
                'image' => 'https://via.placeholder.com/800x400.png?text=Event+Image',
                'class' => 'my-event-card',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem. Sed euismod, nisl nec ultricies lacinia, nisl nisl aliquam nisl, nec aliquam nisl nisl sit amet lorem.'
                ])

            </div>
        </div>
    </div>
</x-app-layout>