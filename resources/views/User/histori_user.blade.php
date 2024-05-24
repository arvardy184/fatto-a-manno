{{-- 1= Bayar Langsung --}}
{{-- 0=Manual --}}
{{-- 2=Masi di keranjang --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">History {{ auth()->user()->name }}</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Gambar</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Size</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Payment Status</th>
                        <th class="px-4 py-2 border">Confirmation Status</th>
                        <th class="px-4 py-2 border">Transaction Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buys as $buy)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border"><img src="{{ $buy->cloth->image_url }}"
                                    class="max-w-24 max-h-24 mx-auto" alt=""></td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->name }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->size }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->type }}</td>
                            <td class="px-4 py-2 border">Rp{{ formatRupiah($buy->total_price) }}</td>
                            <td class="px-4 py-2 border">
                                @if ($buy->payment_method == 1)
                                    Bayar tanpa melalui admin
                                @elseif ($buy->payment_method == 0)
                                    Bayar melalui admin
                                @else
                                    Masih di keranjang
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($buy->payment_status == 1)
                                    Sudah Dibayar
                                @else
                                    Belum Dibayar
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($buy->confirmation_status == 1)
                                    Sudah Dikonfirmasi
                                @elseif($buy->confirmation_status == 0)
                                    Belum Dikonfirmasi
                                @else
                                    Dibatalkan
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $buy->user->created_at }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 justify-between">

        </div>
        <a href="/dashboard"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layout>
