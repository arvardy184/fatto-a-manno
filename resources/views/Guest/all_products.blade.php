<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
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
        <div class="w-full sm:hidden sm:w-96 justify-center border p-5 flex-col grid gap-4" x-data="{ open: false }">
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
        <div class="flex col-3 sm:w-full">
            <div class=" mx-auto max-w-2xl px-4 py-4 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($clothes as $cloth)
                        @include('layouts.card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
