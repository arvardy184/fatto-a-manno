<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (auth()->user()->role_id == 1)
        {{-- admin --}}
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Profile</h2>
            </div>
            <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
                {{-- seno: tampilkan data-data user disini --}}
                @csrf
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->name }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->email }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">
                        Address
                    </label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->address }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->number }}</div>
                </div>
                <div>
                    <a class="mt-1 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        href="/dashboard/ubah_pw">Change password</a>

                    <a class="mt-1 flex w-full justify-center rounded-md bg-gray-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                        href="/dashboard">Back</a>
                </div>
            </div>
        </div>
    @else
        {{-- user --}}
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Profile</h2>
            </div>
            <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
                {{-- seno: tampilkan data-data user disini --}}
                @csrf

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->name }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->email }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Address</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->address }}</div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="border border-gray-300 rounded-md p-2">{{ auth()->user()->number }}</div>
                </div>
                <div>
                    <a class="flex w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                        href="/dashboard/edit_profil">Edit profile</a>
                    <a class="mt-1 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        href="/dashboard/ubah_pw">Change password</a>
                    <a class="mt-1 flex w-full justify-center rounded-md bg-gray-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                        href="/dashboard">Back</a>
                </div>
            </div>
        </div>
    @endif
</x-layout>
