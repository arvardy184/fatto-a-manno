<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto p-12">
        <h1 class="text-center text-2xl font-bold mb-4">Data Pakaian</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Type</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Size</th>
                        <th class="px-4 py-2 border">Color</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Description</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clothes as $cloth)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">
                                <img src="{{ $cloth['image_url'] }}" alt="Cloth Image"
                                    class="max-w-24 max-h-24 mx-auto">
                            </td>
                            <td class="px-4 py-2 border">{{ $cloth['type'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['name'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['size'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['color'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['price_per_piece'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['description'] }}</td>
                            <td class="px-4 py-2 border">{{ $cloth['total_quantity'] }}</td>
                            <td class="px-4 py-2 border">
                                <button>
                                    <a href="/clothes/data/{{ $cloth['id'] }}"
                                        class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2"
                                        onclick="return confirm('Are you sure to edit this clothes?')">Edit</a>
                                </button>
                                <form action="/clothes/delete/{{ $cloth['id'] }}" method="GET" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure to delete this clothes?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 justify-between">
            {{ $clothes->links() }}
        </div>
        <div class="mt-6 flex justify-between">
            <a href="/dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            <a href="/dashboard/data_pakaian/tambah"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add</a>
        </div>
    </div>
</x-layout>
