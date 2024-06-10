{{-- size, color, type, Stored In : dropdown --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex items-center justify-center min-h-screen px-6 py-12 lg:px-8">
        <div class="w-full max-w-md">

            <h2 class="mt-1 mb-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Edit Pakaian</h2>

            <form class="space-y-6" action="/clothes/edit/{{ $clothes->id }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="type" class="block mb-1 text-sm font-semibold text-gray-700">Type</label>
                    <div class="relative">
                        <select id="type" name="type" size="1"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="{{ $clothes->type }}">{{ $clothes->type }}</option>
                            @foreach (['polo', 'turtleneck', 'Plain t-shirt', 'wallet', 'hoodie', 'pants', 'caps', 'Shirt', 'sweater'] as $type)
                                @if ($type !== $clothes->type)
                                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="name" class="block mb-1 text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $clothes->name }}"
                        class="mt-1 block w-full px-3 py-2 border
                        border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500
                        focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="size" class="block mb-1 text-sm font-semibold text-gray-700">Size</label>
                    <div class="relative">
                        <select id="size" name="size"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            size="1">
                            <option value="{{ $clothes->size }}">{{ $clothes->size }}</option>
                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                @if ($size !== $clothes->size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="color" class="block mb-1 text-sm font-semibold text-gray-700">Color</label>
                    <div class="relative">
                        <select id="color" name="color"
                            class="block w-full px-3 py-2 h-10 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            size="1">
                            <option value="{{ $clothes->color }}">{{ $clothes->color }}</option>
                            @foreach (['white', 'black', 'blue', 'brown', 'sage', 'navy'] as $color)
                                @if ($color !== $clothes->color)
                                    <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="price_per_piece" class="block mb-1 text-sm font-semibold text-gray-700">Price</label>
                    <input type="text" id="price_per_piece" name="price_per_piece"
                        value="{{ $clothes->price_per_piece }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="description" class="block mb-1 text-sm font-semibold text-gray-700">Description</label>
                    <input type="text" id="description" name="description" value="{{ $clothes->description }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-6">
                    <label for="image_url" class="w-full block mb-1 text-sm font-semibold text-gray-700">Image
                        Url</label>
                    <input type="text" id="image_url" name="image_url" value="{{ $clothes->image_url }}"
                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit"
                        class="w-full justify-center py-2 px-4 bg-indigo-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                    <a href="/dashboard/data_pakaian"
                        class="justify-center text-center block mt-3 w-full py-2 px-4 bg-sky-600 text-sm font-semibold text-white rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Back</a>
                </div>
            </form>

        </div>
    </div>
</x-layout>
