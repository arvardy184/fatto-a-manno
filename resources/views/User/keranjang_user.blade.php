<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">Cart</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
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
                    @foreach ($buys as $buy)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border"><img src="{{ $buy->cloth->image_url }}" alt=""></td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->name }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->type }}</td>
                            <td class="px-4 py-2 border">{{ $buy->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->color }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->size }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->price_per_piece }}</td>
                            <td class="px-4 py-2 border">{{ $buy->total_price }}</td>
                            <td class="px-4 py-2 border"></td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="mt-3 px-5 justify-between">
            <p>Total Harga</p>
        </div>
        <div x-data="{ pilihPembayaran: false }">
            <button type="button" @click="pilihPembayaran = true"
                class="mt-1 w-80 items-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Pilihan
                Pembayaran</button>

        </div>
        <a href="/dashboard"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layout>
