<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5 p-5">
        <h1 class="text-center text-2xl font-bold mb-4">Data Storage</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Color</th>
                        <th class="px-4 py-2 border">Size</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Stored At</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">
                                <img class="max-w-24 max-h-24 mx-auto" src="{{ $store->clothes->image_url }}"
                                    alt="">
                            </td>
                            <td class="px-4 py-2 border">{{ $store->clothes->type }}</td>
                            <td class="px-4 py-2 border">{{ $store->clothes->name }}</td>
                            <td class="px-4 py-2 border">{{ $store->clothes->color }}</td>
                            <td class="px-4 py-2 border">{{ $store->clothes->size }}</td>
                            <td class="px-4 py-2 border">{{ $store->quantity }}</td>
                            <td class="px-4 py-2 border">{{ $store->clothes->created_at }}</td>
                            <td class="px-4 py-2 border">
                                <button>
                                    <a href="/storage/clothes/data/{{ $store->clothes->id }}"
                                        class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Edit
                                        Stock</a>
                                </button>

                                <form action="/storage/clothes/delete/{{ $store->id }}" method="GET"
                                    class="inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 justify-between">
            {{ $stores->links() }}
        </div>
        <div class="mt-6 flex justify-between">
            <a href="/storage/" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
    </div>
</x-layout>
