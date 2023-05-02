<!-- components/table.blade.php -->
@props(['data'])


@if ($data->isEmpty())
<div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
    No data found.
</div>

@else

    @php
    $headers = $data->first()->getFillable();

    @endphp

<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
    <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            @foreach ($headers as $header)
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700">
        @foreach ($data as $item)
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                @foreach ($headers as $header)
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->$header }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>


@endif
