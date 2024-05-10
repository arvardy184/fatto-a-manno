<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Profile</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- seno: tampilkan data-data user disini --}}
            <form class="space-y-6" action="" method="GET">
                <div class="form-group mb-3">
                    <label for="">Nama Lengkap</label>
                    <input type="" name="nama_lengkap" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <input type="" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">No HP</label>
                    <input type="" name="email" class="form-control" />
                </div>
                <div>
                    <button
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="">Submit</a></button>
                    <button type="submit"
                        class="mt-1 flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard/profile">Back</a></button>
                </div>
            </form>
        </div>
    </div>
</x-layoutDashboard>
