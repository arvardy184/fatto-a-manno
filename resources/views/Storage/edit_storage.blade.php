<x-layoutDashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Storage</h2>
        </div>
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control border border-black rounded" id="floatingInput"
                        name="type">
                    <label for="floatingInput">Nama</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control border border-black rounded" id="floatingPassword"
                        name="name">
                    <label for="floatingInput">Quantity Limit</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control border border-black rounded" id="floatingInput"
                        name="size">
                    <label for="floatingInput">Address</label>
                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    <button type="submit"
                        class="mt-1 flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><a
                            href="/dashboard/data_storage">Back</a></button>
                </div>
            </form>
        </div>
    </div>
</x-layoutDashboard>
