<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Event Promotion List
        </h2>
    </x-slot>

    <div class="py-12">
    @php

    @endphp
    <x-custom-table :data="$eventPromotion" />

    </div>
</x-app-layout>
