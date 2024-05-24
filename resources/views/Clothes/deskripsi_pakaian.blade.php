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
                    <div class="mt-4 lg:row-span-3 lg:mt-0">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-gray-900">
                            Rp{{ formatRupiah($clothes['price_per_piece']) }}</p>
                        <!-- Reviews -->
                        <div class="mt-6">
                            <h3 class="sr-only">Reviews</h3>
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="{{ $i < 4 ? 'text-gray-900' : 'text-gray-200' }} h-5 w-5 flex-shrink-0"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="sr-only">4 out of 5 stars</p>
                                <a href="#"
                                    class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">117
                                    reviews</a>
                            </div>
                        </div>

                        <form class="mt-10">
                            <!-- Colors -->
                            <div>
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">Color</h3>
                                    <h1 class="text-sm">{{ $clothes['color'] }}</h1>
                                </div>
                            </div>

                            <!-- Sizes -->
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Size</h1>
                                    <h3 class="text-sm">{{ $clothes['size'] }}</h3>
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Stok</h1>
                                    <h3 class="text-sm">{{ $clothes['total_quantity'] }}</h3>
                                </div>
                            </div>
                            <div class="mt-10">
                                <div class="flex items-center justify-between">
                                    <h1 class="text-lg font-medium text-gray-900">Quantity</h1>
                                    <div class="mb-1">
                                        <label for="quantity"
                                            class="block mb-1 text-sm font-semibold text-gray-700"></label>
                                        <input type="number" id="quantity" name="quantity"
                                            class="mt-1 block w-20 px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="py-10 lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                                <!-- Description and details -->
                                <div>
                                    <h3 class="sr-only">Description</h3>
                                    <div class="space-y-6">
                                        <p class="text-base text-gray-900">{{ $clothes['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @auth
                                @if (auth()->user()->role_id == 0)
                                    <div class="flex flex-col items-center gap-2" x-data="{ pilihPembayaran: false }">
                                        <button type="button" @click="pilihPembayaran = true"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Pilihan
                                            Pembayaran</button>
                                        <button type="button" id="addToCartButton"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-yellow-600 px-8 py-3 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Masukkan
                                            ke keranjang</button>
                                        <button type="submit"
                                            class="mt-1 flex w-80 items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><a
                                                href="/all_products">back</a></button>
                                        {{-- modal udah login --}}
                                        @include('modal.modal_pembayaran')
                                    </div>
                                @endif
                            @else
                                <div class="flex flex-col items-center gap-2" x-data="{ belumLogin: false }">
                                    <button type="button" @click="belumLogin = true"
                                        class="mt-1 w-80 rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Pilihan
                                        Pembayaran</button>
                                    <button @click="belumLogin = true" type="button"
                                        class="mt-1  w-80 rounded-md border border-transparent bg-yellow-600 px-8 py-3 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Masukkan
                                        ke keranjang</button>
                                    <button type="submit"
                                        class="mt-1 w-80 items-center justify-center rounded-md border border-transparent bg-gray-400 px-8 py-3 text-base font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"><a
                                            href="/all_products">back</a></button>
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
