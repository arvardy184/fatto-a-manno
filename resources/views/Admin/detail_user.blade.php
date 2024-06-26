<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">History {{ $user->name }}</h1>
        <div class="overflow-x-auto">
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Size</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Total price</th>
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
                            <td class="px-4 py-2 border"><img src="{{ $buy->cloth->image_url }}"
                                    class="max-w-24 max-h-24 mx-auto" alt=""></td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->name }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->size }}</td>
                            <td class="px-4 py-2 border">{{ $buy->cloth->type }}</td>
                            <td class="px-4 py-2 border">{{ formatRupiah($buy->total_price) }}</td>
                            <td class="px-4 py-2 border">
                                @if ($buy->payment_method == 1)
                                    Pay without going through admin
                                @elseif ($buy->payment_method == 0)
                                    Pay via admin
                                @else
                                    Still in the cart
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($buy->payment_status == 1)
                                    Already paid
                                @else
                                    Not yet paid
                                @endif
                            </td>
                            <td class="px-4 py-2 border">
                                @if ($buy->confirmation_status == 1)
                                    Has been confirmed
                                @elseif($buy->confirmation_status == 0)
                                    Has not been confirmed
                                @else
                                    Canceled
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $buy->user->created_at }} </td>

                            {{-- confirm status ==0 && payment_status ==1, bisa di klik kedua button --}}
                            <td class="px-4 py-2 border">
                                @if ($buy->confirmation_status == 0 && $buy->payment_status == 1)
                                    <form action="/admin/confirm/{{ $buy->id }}" method="POST">
                                        <input type="hidden" name="confirmation_status" value="1">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
                                            Confirm
                                        </button>
                                    </form>
                                    <form action="/admin/confirm/{{ $buy->id }}" method="POST"
                                        class="inline-block">
                                        <input type="hidden" name="confirmation_status" value="2">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                                    </form>
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
        <a href="{{ url()->previous() }}"
            class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layout>
