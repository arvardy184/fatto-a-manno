{{-- seno: tampilkan semua data user disini --}}
<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-5">
        <h4 class="text-center">Data User</h4>
        <hr />
        <table class="table table-bordered mt-2 text-center col-12">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button
                            class=" mt-1 flex w-full justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                                href=""
                                onclick="return confirm('Are you sure to delete this candidate?')">Delete</a></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="/dashboard" class="btn btn-secondary">Back</a>
    </div>
</x-layoutDashboard>
