<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <div class="bg-white">
            @php
                $sum = 0;
                $text = '';
            @endphp
            @foreach ($buys as $key => $buy)
                <div class="pt-6">
                    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8">
                        <!-- Image -->
                        <div class="justify-center flex">
                            <img src="{{ $buy->cloth->image_url }}" alt="Model wearing plain white basic tee."
                                class="w-full h-full p-5 object-cover object-center">
                        </div>

                        <!-- Product info -->
                        <div class="lg:mt-0 lg:col-span-2 p-5">
                            <div class="lg:col-span-2 lg:border-gray-200 lg:pr-8">
                                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    {{ $buy->cloth->name }}
                                </h1>
                            </div>

                            <!-- Options -->
                            <div class="mt-1 lg:row-span-3 lg:mt-3">
                                <form class="mt-3">
                                    <!-- Colors -->
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-medium text-gray-900">Type</h3>
                                            <h1 class="text-base">{{ $buy->cloth->type }}</h1>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-medium text-gray-900">Color</h3>
                                            <h1 class="text-base">{{ $buy->cloth->color }}</h1>
                                        </div>
                                    </div>
                                    <!-- Sizes -->
                                    <div class="mt-3">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-lg font-medium text-gray-900">Size</h1>
                                            <h3 class="text-base">{{ $buy->cloth->size }}</h3>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-lg font-medium text-gray-900">Harga</h1>
                                            <h3 class="text-base"> Rp{{ formatRupiah($buy->cloth->price_per_piece) }}
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-lg font-medium text-gray-900">Quantity</h1>
                                            <h3 class="text-base">{{ $buy->quantity }}</h3>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-lg font-medium text-gray-900">Total Harga</h1>
                                            <h3 class="text-base">Rp{{ formatRupiah($buy->total_price) }}</h3>
                                        </div>
                                    </div>
                                    <div class="flex justify-end mt-4">
                                        <button
                                            class="inline-block w-20 px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @php
                    $sum += $buy->total_price;
                    if ($key < count($buys) - 1) {
                        // Jika bukan item terakhir, tambahkan koma
                        $text .= $buy->cloth->name . ', ';
                    } else {
                        // Jika item terakhir, tanpa koma
                        $text .= $buy->cloth->name . '.';
                    }
                @endphp
            @endforeach
        </div>

        <div class="flex justify-end mt-3 px-5">
            <div class="bg-gray-600 text-white px-4 py-2 rounded-md">
                <p class="text-lg font-semibold">Total harga seluruhnya: Rp{{ formatRupiah($sum) }}</p>
            </div>
        </div>
        <div x-data="{ pilihPembayaran: false }">
            <button type="button" @click="pilihPembayaran = true"
                class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-base font-semibold leading-6 text-center text-white uppercase bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Pilihan
                Pembayaran</button>
            @include('modal.modal_cart')
        </div>
        <a href="/dashboard"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-base font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
    </div>
</x-layout>
