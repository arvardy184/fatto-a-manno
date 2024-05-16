<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mt-6 flex flex-col sm:flex-row w-full gap-8 ">
        <div class="bg-blue-500 sm:w-96">01</div>
        <div class="flex bg-red-500 col-3 sm:w-full">
            <div class=" border mx-auto max-w-2xl px-4 py-4 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($clothes as $cloth)
                        @include('layouts.card')
                    @endforeach
                </div>
            </div>
        </div>
</x-layout>
