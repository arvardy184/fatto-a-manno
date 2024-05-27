<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto p-12">
        @if (session('errors'))
            @include('components.view_modal')
        @endif
        <h1 class="text-center text-2xl font-bold mb-4">Data Storage</h1>
        <div class="overflow-x-auto">
            <div class="flex lg:ms-0 sm:ms-20 ms-40 justify-center py-3 px-6 border-b">
                <form action="/dashboard/data_storage" method="GET" class="flex items-center mx-auto  lg:justify-end">
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
                                <button>
                                    <a href="/storage/clothes/{{ $storage['id'] }}"
                                        class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
                                </button>
                                <button>
                                    <a href="/storage/data/{{ $storage['id'] }}"
                                        class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Edit</a>
                                </button>
                                <form action="/storage/delete/{{ $storage['id'] }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure to delete this storage?')">Delete</button>
                                </form>
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
