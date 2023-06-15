<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <x-custom-container-alt>
        <form class="mb-3" name="searchAndFilterUser" method="post" action="{{ route('admin.userListFilter') }}">
            @csrf

            <div class="relative mb-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div class="flex items-center space-x-2 ">
                    <input type="search" name="user_search_keyword" id="user_search_keyword"
                        class="inline-block w-2/4 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search User Name" value=" {{ isset($keyword) ? $keyword : '' }}">
                    <svg data-dropdown-toggle="dropdownAction" fill="none" class="text-black dark:text-white w-8"
                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75">
                        </path>
                    </svg>
                    <div id="dropdownAction"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownActionButton">

                            @foreach ($roles as $role_code => $role_name)
                                <li onclick="storeUserRole('{{ $role_code }}')"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ $role_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" id="role_code" name="role_code"
                        value="{{ isset($selected_role) ? $selected_role : '' }}">
                    <input type="hidden" id="roles" name="roles" value="{{ $roles }}">
                    <button type="submit"
                        class="inline-block text-sm px-4 mt-2 py-2 bg-primary hover:bg-accent-2 hover:text-secondary text-white font-bold rounded-md">Search</button>
                </div>

            </div>


            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">

                @if (isset($filter))
                    <p class="m-2 text-gray-400"> <i>{{ $filter }}</i></p>
                @endif
                <table class=" text-black table-auto w-full">
                    <thead>
                        <tr class=" bg-gray-100">
                            <th class=" px-4 py-2">{{ __('Name') }}</th>
                            <th class="px-4 py-2">{{ __('UTM ID') }}</th>
                            <th class="px-4 py-2">{{ __('Email') }}</th>
                            <th class="px-4 py-2">{{ __('Role') }}</th>
                            <th class="px-4 py-2">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="hover:bg-slate-400">
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->utm_id }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">{{ $user->role_code }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('admin.editUser', $user->id) }}"
                                        class="bg-secondary hover:bg-accent-2 hover:text-black text-white font-bold py-2 px-4 rounded">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <div class="p-2">
                {{ $users->appends(request()->except('page'))->links() }} </div>
        </form>
    </x-custom-container-alt>


</x-app-layout>

<script>
    // to store selected value in hidden field
    function storeUserRole($role_code) {
        document.getElementById('role_code').value = $role_code;
        document.getElementById('dropdownAction').classList.toggle('hidden');
    }
</script>
