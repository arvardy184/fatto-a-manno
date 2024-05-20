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
                            <th class="px-4 py-2 border">Type</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Size</th>
                            <th class="px-4 py-2 border">Color</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clothes as $cloth)
                            <tr class="bg-gray-100 even:bg-gray-200">
                                <td class="px-4 py-2 border">{{ $cloth->type }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->name }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->size }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->color }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->price_per_piece }}</td>
                                <td class="px-4 py-2 border">{{ $cloth->description }}</td>
                                <td class="px-4 py-2 border">
                                    <img src="{{ $cloth->image_url }}" alt="Cloth Image"
                                        class="max-w-24 max-h-24 mx-auto">
                                </td>
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
                <a href="/dashboard/detail_items"
                    class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
            </button>
        </div>


        {{-- admin end --}}
    @else
        {{-- user start --}}
        <div class="mt-6 flex flex-col sm:flex-row w-full gap-8">
            <div class="hidden  sm:flex sm:w-96 p-5 flex-col grid gap-4">
                <div class="flex gap-1 place-items-center px-4 py-2">
                    <i class="fa-solid fa-list" style="color: #000000;"></i>
                    <h4 class="text-2xl font-bold">Category</h4>
                </div>
                <ul class="py-1 px-2">
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">All Products</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Polo Shirt</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Turtleneck</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kaos Polos</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Wallet</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Oversized Hoodie</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Short Pants</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Long Pants</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Caps</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Flanel</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Lengan Panjang</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Lengan Pendek</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Sweater</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Sablon/Print</a></li>
                    <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Clearance Sale</a></li>
                </ul>
            </div>
            <div class="w-full sm:hidden sm:w-96 justify-center border p-5 flex-col grid gap-4"
                x-data="{ open: false }">
                <button @click="open = ! open"
                    class="text-white bg-blue-950 hover:bg-blue-800 font-medium text-sm px-4 py-2.5 rounded-lg inline-flex items-center focus:ring-4 focus:outline-none focus:ring-blue-300  text-center">Category</button>
                {{-- Dropdown --}}
                <div x-show="open" @click.away="open=false"
                    class="z-10 bg-white divide-y divide-gray-50 rounded shadow w-44">
                    <ul class="text-sm py-1 px-2">
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">All Products</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Polo Shirt</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Turtleneck</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kaos Polos</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Wallet</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Oversized Hoodie</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Short Pants</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Long Pants</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Caps</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Flanel</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Lengan Panjang</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Kemeja Lengan Pendek</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Sweater</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Sablon/Print</a></li>
                        <li><a class="block px-4 py-2 hover:bg-gray-100" href="">Clearance Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex col-3 sm:w-full mx-auto">
                <div class=" mx-auto max-w-2xl px-4 py-4 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach ($clothes as $cloth)
                            @include('layouts.card')
                        @endforeach
                    </div>
                    <div class="mt-3 justify-between">
                        {{ $clothes->links() }}
                    </div>
                </div>
            </div>
        </div>
        {{-- user end --}}
    @endif
</x-layout>
