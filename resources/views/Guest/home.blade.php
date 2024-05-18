<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
        <div class=" border mx-auto max-w-2xl px-4 py-4 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Best Seller</h2>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          
            </div>
            <div class="flex sm:justify-end justify-center mt-5 border">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    See More Details
                </button>
            </div>
        </div>
</x-layout>
