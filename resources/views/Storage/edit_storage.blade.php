<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex justify-center min-h-screen px-6 py-12 lg:px-8">
        <div class="w-full max-w-md">
            <h2 class="mt-1 mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Storage
            </h2>
            <form class="space-y-6" action="/storage/edit/{{ $storages->id }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="type" class="block mb-1 text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" id="type" name="name" value="{{ $storages->name }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="name" class="block mb-1 text-sm font-semibold text-gray-700">Quantity Limit</label>
                    <input type="text" id="name" name="quantity_limit" value="{{ $storages->quantity_limit }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="size" class="block mb-1 text-sm font-semibold text-gray-700">Address</label>
                    <input type="text" id="size" name="address" value="{{ $storages->address }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit"
                        class="w-full justify-center py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                    <a href="/storage/"
                        class="justify-center text-center block mt-3 w-full py-2 px-4 bg-sky-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
