@php
    $name = 'my-select';
    $label = 'My Select';
    $options = [
        '1' => 'Option 1',
        '2' => 'Option 2',
        '3' => 'Option 3',
    ];
    $selected = 2;
@endphp

<div>
    <x-label for="{{ $name }}" :value="$label" />

    <select id="{{ $name }}" name="{{ $name }}" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300!important">
        <option value="">--Select--</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
