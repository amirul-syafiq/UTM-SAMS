@props([
    'title' => '',
    'buttonText' => 'Submit',
    'action' => '',
    'method' => 'POST',
])

<div >

    <div
        {{ $attributes->merge(['class' => 'max-w-3xl mx-auto my-6 px-4 py-8 bg-white dark:bg-gray-800 shadow rounded-md']) }}>
        <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">{{ $title }}</h2>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            {{ $slot }}

            {{-- Show the actions if defined --}}


            {{-- Show the submit button if no other action is defined --}}
            @if (empty($actions))
                <div class="flex justify-end mt-4">
                    <x-button  id="submitButton" name="submitButton">{{ $buttonText }}</x-button>
                </div>
            @else
                <div class="mt-10">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
