<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $clubEvent->event_name  }}
            @if (isset($eventPromotion))
                {{ __('Edit Event') }}
            @else
                {{ __('Create Event') }}
            @endif
        </h2>
    </x-slot>
</x-app-layout>
