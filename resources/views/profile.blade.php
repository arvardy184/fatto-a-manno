<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- seno: ini untuk user --}}
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Profile</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- seno: tampilkan data-data user disini --}}
            <form class="space-y-6" action="" method="GET">
                <div class="form-group mb-3">
                    <label for="">Nama Lengkap</label>
                    <input type="hidden" name="nama_lengkap" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">No HP</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div>
                    <button
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard/edit_profil">Edit Profil</a></button>
                    <button
                        class="mt-1 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard/edit_profil">Ubah Password</a></button>
                    <button type="submit"
                        class="mt-1 flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard">Back</a></button>
                </div>
            </form>
        </div>
    </div>
    {{-- seno: ini untuk admin --}}
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Profile</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- seno: tampilkan data-data admin disini --}}
            <form class="space-y-6" action="" method="GET">
                <div class="form-group mb-3">
                    <label for="">Nama Lengkap</label>
                    <input type="hidden" name="nama_lengkap" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Alamat</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label for="">No HP</label>
                    <input type="hidden" name="email" class="form-control" />
                </div>
                <div>
                    <button type="submit"
                        class="mt-1 flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard">Back</a></button>
                </div>
            </form>
        </div>
    </div>
</x-layoutDashboard>
