<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
        <div class="pt-1">
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                <!-- Image -->
                <div
                    class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg lg:col-span-1">
                    <img src="{{ $buy->cloth->image_url }}" alt="Model wearing plain white basic tee."
                        class="h-full w-full p-5 object-cover object-center">
                </div>

                <!-- Product info -->
                <div class="lg:mt-0 lg:col-span-2 p-5">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                            {{ $buy->cloth->name }}
                        </h1>
                    </div>

                    <!-- Options -->
                    <div class="mt-1 lg:row-span-3 lg:mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-gray-900">
                            Rp{{ formatRupiah($buy->cloth->price_per_piece) }}</p>

                        <div class="mt-3">
                            <!-- Colors -->
                            <div>
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">Color</h3>
                                    <h1 class="text-sm">{{ $buy->cloth->color }}</h1>
                                </div>
                            </div>

                            <!-- Sizes -->
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Size</h1>
                                    <h3 class="text-sm">{{ $buy->cloth->size }}</h3>
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Stok</h1>
                                    <h3 class="text-sm">{{ $buy->cloth->total_quantity }}</h3>
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Quantity</h1>
                                    <div class="mb-1">
                                        <label for="quantity"
                                            class="block mb-1 text-sm font-semibold text-gray-700"></label>
                                        <input type="number" id="quantity" name="quantity"
                                            class="mt-1 block w-20 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            value="{{ $buy->quantity }}">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <button id="addQ"
                                    class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-blue-600 px-8 py-3 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <a href="/dashboard/keranjang_user"
                    class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('addQ').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            const quantity = document.getElementById('quantity').value;
            const url = `/buy/cart/edit/buy/{{ $buy->id }}?quantity=${quantity}`;
            window.location.href = url;
        });
    </script>
</x-layout>
