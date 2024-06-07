<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex justify-center min-h-screen px-6 py-12 border lg:px-8">
        <div class="w-full max-w-md mt-44">

            <h2 class="mt-1 mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Pakaian</h2>
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            <form class="space-y-6" action="/storage/clothes/edit/{{ $stores->id }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="type" class="block mb-1 text-sm font-semibold text-gray-700">Quantity</label>
                    <input type="number" id="type" name="quantity" value="{{ $stores->quantity }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <button type="submit"
                        class="w-full justify-center py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                    <a href="{{ url()->previous() }}"
                        class="justify-center text-center block mt-3 w-full py-2 px-4 bg-sky-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
