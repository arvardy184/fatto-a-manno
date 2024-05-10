<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <h1 class="text-center">Data Pakaian</h1>
        <hr />
        <table class="table table-bordered mt-2 text-center col-12">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image URL</th>
                    <!-- <th>Stored In</th> -->
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clothes as $cloth)
                <tr>
                    <td>{{ $cloth['type'] }}</td>
                    <td>{{ $cloth['name'] }}</td>
                    <td>{{ $cloth['size'] }}</td>
                    <td>{{ $cloth['color'] }}</td>
                    <td>{{ $cloth['price_per_piece'] }}</td>
                    <td>{{ $cloth['description'] }}</td>
                    <td><img src="{{ $cloth['image_url'] }}" alt="Cloth Image" style="max-width: 100px; max-height: 100px;"></td>
                    <!-- <td>{{ $cloth['stored_in'] }}</td> -->
                    <td>{{ $cloth['total_quantity'] }}</td>
                    <td>
                        <button class="mt-1 flex w-full justify-center rounded-md bg-cyan-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <a href="/dashboard/data_pakaian/edit/{{ $cloth['id'] }}" onclick="return confirm('Are you sure to edit this clothes?')">Edit</a>
                        </button>
                        <form action="/deleteClothes/{{ $cloth['id'] }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-1 flex w-full justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="return confirm('Are you sure to delete this clothes?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-secondary"><a href="/dashboard">Back</a></button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-primary"><a href="/dashboard/data_pakaian/tambah">Add</a></button>
            </div>
        </div>
    </div>
</x-layoutDashboard>
