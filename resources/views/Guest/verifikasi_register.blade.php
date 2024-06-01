<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-center px-10 mt-60"> <!-- Tambahkan kelas overflow-hidden -->
        <div class="w-full max-w-md">

            <h2 class="mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Verification has
                been sent! check your email</h2>

            <form class="space-y-6" action="" method="POST">
                <div>
                    <button type="submit"
                        class="w-full justify-center py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                </div>
            </form>

        </div>
    </div>
</x-layout>
