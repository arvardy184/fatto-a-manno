<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">History User</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Payment Status</th>
                        <th class="px-4 py-2 border">Confirmation Status</th>
                        <th class="px-4 py-2 border">Transaction Date</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buys as $buy)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">{{ $buy->user->name }}</td>
                            <td class="px-4 py-2 border">{{ $buy->payment_method }}</td>
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
                            <td x-data="{ konfirmasi: false }" class="px-4 py-2 border">
                                @if ($buy->payment_status == 0)
                                    <button @click="konfirmasi = true"
                                        class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-yellow-500 rounded hover:bg-yellow-300 focus:outline-none">Confirmation</button>
                                    <x-confirmation>Payment has not been paid by
                                        {{ $buy->user->name }}</x-confirmation>
                                    <form action="/admin/confirm/{{ $buy->id }}?confirmation_status=2"
                                        method="POST">
                                        @csrf
                                        <button
                                            class="inline-block mt-1 w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">Cancel</button>
                                    </form>
                                @elseif ($buy->confirmation_status == 0)
                                    <form action="/admin/confirm/{{ $buy->id }}?confirmation_status=1"
                                        method="POST">
                                        @csrf
                                        <button
                                            class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-yellow-500 rounded hover:bg-yellow-300 focus:outline-none">Confirmation</button>
                                    </form>
                                    <form action="/admin/confirm/{{ $buy->id }}?confirmation_status=2"
                                        method="POST">
                                        @csrf
                                        <button
                                            class="inline-block mt-1 w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">Cancel</button>
                                    </form>
                                @else
                                    <button @click="konfirmasi = true"
                                        class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-yellow-500 rounded hover:bg-yellow-300 focus:outline-none">Confirmation</button>
                                    <button @click="konfirmasi = true"
                                        class="inline-block mt-1 w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">Cancel</button>
                                    <x-confirmation>Transaction completed</x-confirmation>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 justify-between">
            {{ $buys->links() }}
        </div>
        <a href="/dashboard/data_pengguna"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layout>
