<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <h1 class="text-center">Data Storage</h1>
        <hr />
        <table class="table table-bordered mt-2 text-center col-12">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity Limit</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class="mt-1 flex w-full justify-center rounded-md bg-cyan-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <a href="/dashboard/data_storage/edit"
                                onclick="return confirm('Are you sure to edit this Storage?')">Edit</a>
                        </button>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit"
                                class="mt-1 flex w-full justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                onclick="return confirm('Are you sure to delete this Storage?')">Delete</button>
                        </form>
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
                <button type="button" class="btn btn-primary"><a href="/dashboard/data_storage/tambah">Add</a></button>
            </div>
        </div>
    </div>
</x-layoutDashboard>
