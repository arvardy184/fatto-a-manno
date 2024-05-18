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
                    @foreach ($users as $user)
                        <tr class="bg-gray-100 even:bg-gray-200">
                            <td class="px-4 py-2 border">{{ $user['name'] }}</td>
                            <td class="px-4 py-2 border">{{ $user['email'] }}</td>
                            <td class="px-4 py-2 border">{{ $user['address'] }}</td>
                            <td class="px-4 py-2 border">{{ $user['number'] }}</td>
                            <td class="px-4 py-2 border">
                                <form action="/user/delete/{{ $user['id'] }}" method="POST">
                                    @csrf
                                    <button
                                        class="inline-block w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="/dashboard"
            class="block w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
    </div>
</x-layoutDashboard>
