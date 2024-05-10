{{-- seno: ini untuk get semua data pakaian --}}
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
                    <th>Stored In</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class=" mt-1 flex w-full justify-center rounded-md bg-cyan-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                                href="/dashboard/data_pakaian/edit"
                                onclick="return confirm('Are you sure to edit this clothes?')">Edit</a></button>
                        <button
                            class=" mt-1 flex w-full justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                                href=""
                                onclick="return confirm('Are you sure to delete this clothes?')">Delete</a></button>
                    </td>
                </tr>
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
