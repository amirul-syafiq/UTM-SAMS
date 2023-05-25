@props(['rows' => 4, 'name' => 'message', 'placeholder' => 'Write your thoughts here...', 'maxlength' => '5000'])

<textarea {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full', 'id' => $name, 'rows' => $rows, 'name' => $name, 'placeholder' => $placeholder, 'maxlength'=>$maxlength]) }}>{{ $slot }}</textarea>
