<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Tambah Pakaian</h2>
        </div>
        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/clothes/add" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="type" class="block mb-1 text-sm font-semibold text-gray-700">Type</label>
                    <div class="relative">
                        <select id="type" name="type" size="1"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                            <option value=""></option>
                            <option value="polo">Polo</option>
                            <option value="turtleneck">Turtleneck</option>
                            <option value="Plain t-shirt">Plain t-shirt</option>
                            <option value="wallet">Wallet</option>
                            <option value="hoodie">Hoodie</option>
                            <option value="pants">Pants</option>
                            <option value="caps">Caps</option>
                            <option value="Shirt">Shirt</option>
                            <option value="sweater">Sweater</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="name" class="block mb-1 text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="size" class="block mb-1 text-sm font-semibold text-gray-700">Size</label>
                    <div class="relative">
                        <select id="size" name="size"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            size="1">
                            <option value=""></option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="color" class="block mb-1 text-sm font-semibold text-gray-700">Color</label>
                    <div class="relative">
                        <select id="color" name="color"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            size="1">
                            <option value=""></option>
                            <option value="white">White</option>
                            <option value="black">Black</option>
                            <option value="blue">Blue</option>
                            <option value="brown">Brown</option>
                            <option value="sage">Sage</option>
                            <option value="navy">Navy</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="price_per_piece" class="block mb-1 text-sm font-semibold text-gray-700">Price</label>
                    <input type="text" id="price_per_piece" name="price_per_piece"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="description" class="block mb-1 text-sm font-semibold text-gray-700">Description</label>
                    <input type="text" id="description" name="description"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="image_url" class="w-full block mb-1 text-sm font-semibold text-gray-700">Image
                        Url</label>
                    <input type="text" id="image_url" name="image_url"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-6">
                    <label for="type" class="block mb-1 text-sm font-semibold text-gray-700">Stored In</label>
                    <div class="relative">
                        <select id="type" name="stored_in" size="1"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value=""></option>
                            @foreach ($storages as $storage)
                                <option value="{{ $storage['name'] }}">{{ $storage['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="quantity" class="block mb-1 text-sm font-semibold text-gray-700">Quantity</label>
                    <input type="text" id="quantity" name="quantity"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <button type="submit"
                        class="w-full justify-center py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add</button>
                    <a href="/dashboard/data_pakaian"
                        class="justify-center text-center block mt-3 w-full py-2 px-4 bg-sky-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
