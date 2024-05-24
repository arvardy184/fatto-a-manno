<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">Cart</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center mt-5">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Gambar</th>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Warna</th>
                        <th class="px-4 py-2 border">Ukuran</th>
                        <th class="px-4 py-2 border">Harga</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum = 0;
                        $text = '';
                    @endphp
                    @foreach ($buys as $key => $buy)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border"><img src="{{ $buy->cloth->image_url }}"
                                    class="max-w-24 max-h-24 mx-auto" alt=""></td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->name }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->type }}</td>
                            <td class="px-4 py-2 border">{{ $buy->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->color }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->size }}</td>
                            <td class="px-4 py-2 border">Rp{{ formatRupiah($buy->cloth->price_per_piece) }}</td>
                            <td class="px-4 py-2 border">Rp{{ formatRupiah($buy->total_price) }}</td>
                            <td class="px-4 py-2 border">
                                <button
                                    class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">Delete</button>
                            </td>
                        </tr>
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
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-3 px-5">
            <div class="bg-gray-600 text-white px-4 py-2 rounded-md">
                <p class="text-lg font-semibold">Total Harga: Rp{{ formatRupiah($sum) }}</p>
            </div>
        </div>
        <div x-data="{ pilihPembayaran: false }">
            <button type="button" @click="pilihPembayaran = true"
                class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Pilihan
                Pembayaran</button>
            @include('modal.modal_cart')
        </div>
        <a href="/dashboard"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layout>
