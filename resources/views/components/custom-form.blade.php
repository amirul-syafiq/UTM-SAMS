
@props([
    'title' => '',
    'buttonText' => '',
    'action' => '',
    'method' => 'POST',
])

<div {{ $attributes->merge(['class' => 'max-w-3xl mx-auto my-6 px-4 py-8 bg-white dark:bg-gray-800 shadow rounded-md']) }}>
    <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">{{ $title }}</h2>

    <form action="{{ $action }}" method="POST">
        @csrf
        @method($method)
        {{ $slot }}

        <div class="mt-4">
            <x-button>{{ $buttonText }}</x-button>
        </div>
    </form>
</div>
