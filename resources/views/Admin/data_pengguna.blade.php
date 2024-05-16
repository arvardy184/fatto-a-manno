<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <h1 class="text-center text-2xl font-bold mb-4">Data User</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">Address</th>
                        <th class="px-4 py-2 border">Number</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-100 even:bg-gray-200">
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border">
                            <button
                                class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700"
                                onclick="return confirm('Are you sure to delete this candidate?')">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="/dashboard"
            class="block w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layoutDashboard>
