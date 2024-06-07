<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto p-12">
        @if (session('errors'))
            @include('components.view_modal')
        @endif
        <h1 class="text-center text-2xl font-bold mb-4">Data Storage</h1>
        <div class="overflow-x-auto">
            <div class="flex lg:ms-0 sm:ms-20 ms-40 justify-center py-3 px-6 border-b">
                <form action="/dashboard/data_storage" method="GET" class="flex items-center mx-auto lg:justify-end">
                    @csrf
                    <input type="text" name="name" placeholder="Search" autocomplete="off" aria-label="Search"
                        class="lg:w-80 relative pr-3 py-2 font-semibold placeholder-gray-500 text-black rounded-2xl border-none ring-2 ring-gray-300 focus:ring-gray-500 focus:ring-2">
                    <button type="submit"
                        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Search</button>
                </form>
            </div>
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Quantity Limit</th>
                        <th class="px-4 py-2 border">Address</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storages as $storage)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">{{ $storage['name'] }}</td>
                            <td class="px-4 py-2 border">{{ $storage['quantity_limit'] }}</td>
                            <td class="px-4 py-2 border">{{ $storage['address'] }}</td>
                            <td class="px-4 py-2 border">
                                <a href="/storage/clothes/{{ $storage['id'] }}"
                                    class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
                                <a href="/storage/data/{{ $storage['id'] }}"
                                    class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Edit</a>
                                <div x-data="{ deletee: false }">
                                    <form action="/storage/delete/{{ $storage['id'] }}" method="POST">
                                        @csrf
                                        <button type="button" @click="deletee = true"
                                            onclick="document.getElementById('deletee').classList.remove('hidden')"
                                            class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                                        <!-- Hidden Submit Button -->
                                        <button type="submit" x-ref="submitButton" class="hidden">Submit</button>
                                    </form>

                                    <div x-show="deletee" id="deletee"
                                        class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity">
                                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                            <div
                                                class="flex h-96 items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div
                                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <svg class="h-6 w-6 text-red-600" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                                    id="modal-title">
                                                                    Are you sure you want to delete it?</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                        <button @click="$refs.submitButton.click()" type="button"
                                                            class="inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto">Delete</button>
                                                        <button @click="deletee = !deletee" type="button"
                                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-3 justify-between">
            {{ $storages->appends(['users_page' => request()->users_page, 'storages_page' => request()->storages_page])->fragment('clothes')->links() }}
        </div>
        <div class="mt-6 flex justify-between">
            <a href="/dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            <a href="/dashboard/data_storage/tambah"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add</a>
        </div>
    </div>
</x-layout>
