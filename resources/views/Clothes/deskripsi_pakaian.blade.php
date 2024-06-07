<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
        <div class="pt-6">
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            @if (session('url'))
                <script>
                    window.open('{{ session('url') }}', '_blank');
                </script>
            @endif
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                <!-- Image -->
                <div
                    class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg lg:col-span-1">
                    <img src="{{ $clothes['image_url'] }}" alt="Model wearing plain white basic tee."
                        class="h-full w-full p-5 object-cover object-center">
                </div>

                <!-- Product info -->
                <div class="lg:mt-0 lg:col-span-2 p-5">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $clothes['name'] }}
                        </h1>
                    </div>

                    <!-- Options -->
                    <div class="mt-1 lg:row-span-3 lg:mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-gray-900">
                            Rp{{ formatRupiah($clothes['price_per_piece']) }}</p>
                        <div class=" mt-3 lg:border-gray-200">
                            <!-- Description and details -->
                            <div>
                                <h3 class="sr-only">Description</h3>
                                <div class="space-y-6">
                                    <p class="text-base text-gray-900">{{ $clothes['description'] }}</p>
                                </div>
                            </div>
                        </div>

                        <form class="mt-3">
                            <!-- Colors -->
                            <div>
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">Color</h3>
                                    <h1 class="text-sm">{{ $clothes['color'] }}</h1>
                                </div>
                            </div>

                            <!-- Sizes -->
                            <div class="mt-3">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Size</h1>
                                    <h3 class="text-sm">{{ $clothes['size'] }}</h3>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Stok</h1>
                                    <h3 class="text-sm">{{ $clothes['total_quantity'] }}</h3>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Quantity</h1>
                                    <div class="mb-1">
                                        <label for="quantity"
                                            class="block mb-1 text-sm font-semibold text-gray-700"></label>
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            class="mt-1 block w-20 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            @auth
                                @if (auth()->user()->role_id == 0)
                                    <div class="flex flex-col items-center gap-2" x-data="{ pilihPembayaran: false }">
                                        <button type="button" @click="pilihPembayaran = true"
                                            onclick="document.getElementById('pilihPembayara').classList.remove('hidden')"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Choose payment method</button>
                                        <button type="button" id="addToCartButton"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-yellow-600 px-8 py-3 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Add
                                            to cart</button>
                                        <a href="/all_products"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</a>
                                        {{-- modal udah login --}}
                                        @include('modal.modal_pembayaran')
                                    </div>
                                @endif
                            @else
                                <div class="flex flex-col items-center gap-2" x-data="{ belumLogin: false }">
                                    <button onclick="document.getElementById('BelumLogin').classList.remove('hidden')"
                                        type="button" @click="belumLogin = true"
                                        class="mt-1 w-80 rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Choose
                                        payment method</button>
                                    <button @click="belumLogin = true" type="button"
                                        onclick="document.getElementById('BelumLogin').classList.remove('hidden')"
                                        class="mt-1  w-80 rounded-md border border-transparent bg-yellow-600 px-8 py-3 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Add
                                        to cart</button>
                                    <a href="/all_products"
                                        class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back</a>
                                    {{-- modal udah login --}}
                                    @include('modal.modal_guest')
                                </div>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addToCartButton').addEventListener('click', function() {
            const quantity = document.getElementById('quantity').value;
            const url =
                `/tambah_pembayaran?cloth_id={{ $clothes['id'] }}&quantity=${quantity}&payment_method=2&payment_status=0`;
            window.location.href = url;
        });
    </script>
</x-layout>
