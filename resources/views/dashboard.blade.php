<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (auth()->user()->role_id == 1)
        {{-- admin start --}}
        <div id="clothes" class="container mx-auto mt-5">
            <h1 class="text-center text-2xl font-bold mb-4">Data Pakaian</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border text-center">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Type</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Size</th>
                            <th class="px-4 py-2 border">Color</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clothes as $cloth)
                            <tr class="bg-gray-100 even:bg-gray-200">
                                <td class="px-4 py-2 border">
                                    <img src="{{ $cloth->image_url }}" alt="Cloth Image"
                                        class="max-w-24 max-h-24 mx-auto">
                                </td>
                                <td class="px-4 py-2 border">{{ $cloth->type }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->name }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->size }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->color }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->price_per_piece }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->description }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->total_quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 justify-between">
                {{ $clothes->appends(['users_page' => request()->users_page, 'storages_page' => request()->storages_page])->fragment('clothes')->links() }}
            </div>
            <button class="mt-3">
                <a href="/dashboard/data_pakaian"
                    class="block w-full  bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
            </button>
        </div>

        <div id="storages" class="container mx-auto mt-5">
            <h1 class="text-center text-2xl font-bold mb-4">Data Storage</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border text-center">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Quantity Limit</th>
                            <th class="px-4 py-2 border">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($storages as $storage)
                            <tr class="bg-gray-100 even:bg-gray-200">
                                <td class="px-4 py-2 border">{{ $storage->name }}</td>
                                <td class="px-4 py-2 border">{{ $storage->quantity_limit }}</td>
                                <td class="px-4 py-2 border">{{ $storage->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 justify-between">
                <!-- Konten di sebelah kanan (pagination links) -->
                {{ $storages->appends(['clothes_page' => request()->clothes_page, 'users_page' => request()->users_page])->fragment('storages')->links() }}
            </div>

            <button class="mt-3">
                <a href="/storage/"
                    class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
            </button>
        </div>

        <div id="users" class="container mt-5 mx-auto">
            <h1 class="text-center text-2xl font-bold mb-4">Data User</h1>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border text-center">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Address</th>
                            <th class="px-4 py-2 border">Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-gray-100 even:bg-gray-200">
                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                <td class="px-4 py-2 border">{{ $user->address }}</td>
                                <td class="px-4 py-2 border">{{ $user->number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 justify-between">
                {{ $users->appends(['clothes_page' => request()->clothes_page, 'storages_page' => request()->storages_page])->fragment('users')->links() }}
            </div>
            <button class="mt-3">
                <a href="/dashboard/data_pengguna"
                    class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
            </button>
        </div>


        {{-- admin end --}}
    @else
        {{-- user start --}}
        @include('layouts.CategoryFilters')
        {{-- user end --}}
    @endif
</x-layout>
