<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">Data Storage</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Quantity Limit</th>
                        <th class="px-4 py-2 border">Address</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($storages as $storage)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">{{ $storage['name'] }}</td>
                            <td class="px-4 py-2 border">{{ $storage['quantity_limit'] }}</td>
                            <td class="px-4 py-2 border">{{ $storage['address'] }}</td>
                            <td class="px-4 py-2 border">
                                <button>
                                    <a href="/dashboard/detail_items"
                                        class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-2">Detail</a>
                                </button>
                                <button>
                                    <a href="/storage/data/{{ $storage['id'] }}"
                                        class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2"
                                        onclick="return confirm('Are you sure to edit this storage?')">Edit</a>
                                </button>
                                <form action="/storage/delete/{{ $storage['id'] }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure to delete this storage?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-between">
            <a href="/dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            <a href="/dashboard/data_storage/tambah"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add</a>
        </div>
    </div>
</x-layoutDashboard>
