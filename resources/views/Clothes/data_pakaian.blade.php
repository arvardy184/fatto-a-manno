<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
        <form action="{{ route('Data Pakaian') }}" method="GET" x-show="test">
            <div x-data="{ test: false }">
                @if (session('errors'))
                    @include('components.view_modal')
                @endif

                {{-- mobile --}}
                <div x-show="test" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
                    <div x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-40 flex">
                        <div
                            class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                            <div class="flex items-center justify-between px-4">
                                <h2 class="text-lg font-medium text-gray-900">Filter</h2>

                                {{-- close button --}}
                                <button @click="test = false" type="button"
                                    class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Filters -->

                            <div class="mt-4 border-t border-gray-200">
                                @php
                                    $color = '';
                                    $size = '';
                                    $type = '';
                                @endphp
                                @csrf
                                <div x-data="{ expanded: false }" class="border-t border-gray-200 px-4 py-6">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button type="button" @click="expanded = ! expanded"
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-mobile-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Color</span>
                                            <span class="ml-6 flex items-center">
                                                <!-- Expand icon, show/hide based on section open state. -->
                                                <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                </svg>
                                                <!-- Collapse icon, show/hide based on section open state. -->
                                                <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="expanded" class="pt-6" id="filter-section-mobile-0">
                                        <div class="space-y-6">
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-0" name="color" value="white"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-0"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">White</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-1" name="color" value="beige"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-1"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Beige</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-2" name="color" value="blue"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-2"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Blue</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-3" name="color" value="brown"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-3"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Brown</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-4" name="color" value="green"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Green</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-color-5" name="color" value="purple"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-color-5"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Purple</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ expanded: false }" class="border-t border-gray-200 px-4 py-6">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button @click="expanded = ! expanded" type="button"
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-mobile-1" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Type</span>
                                            <span class="ml-6 flex items-center">
                                                <!-- Expand icon, show/hide based on section open state. -->
                                                <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                </svg>
                                                <!-- Collapse icon, show/hide based on section open state. -->
                                                <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="expanded" class="pt-6" id="filter-section-mobile-1">
                                        <div class="space-y-6">
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-0" name="type" value="Polo"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-0"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Polo</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-1" name="type" value="Turtleneck"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-1"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Turtleneck</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-2" name="type" value="Plain t-shirt"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-2"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Plain t-shirt</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-3" name="type" value="Wallet"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-3"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Wallet</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-4" name="type" value="Hoodie"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Hoodie</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-4" name="type" value="Pants"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Pants</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-4" name="type" value="Caps"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Caps</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-4" name="type" value="Shirt"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Shirt</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-type-4" name="type" value="Sweater"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-type-4"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Sweater</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ expanded: false }" class="border-t border-gray-200 px-4 py-6">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button @click="expanded = ! expanded" type="button"
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-mobile-2" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Size</span>
                                            <span class="ml-6 flex items-center">
                                                <!-- Expand icon, show/hide based on section open state. -->
                                                <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                </svg>
                                                <!-- Collapse icon, show/hide based on section open state. -->
                                                <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="expanded" class="pt-6" id="filter-section-mobile-2">
                                        <div class="space-y-6">
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-0" name="size" value="S"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-0"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">S</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-1" name="size" value="M"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-1"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">M</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-2" name="size" value="L"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-2"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">L</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-3" name="size" value="XL"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-3"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ expanded: false }" class="border-t border-gray-200 px-4 py-6">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button @click="expanded = ! expanded" type="button"
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-mobile-2" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Sort</span>
                                            <span class="ml-6 flex items-center">
                                                <!-- Expand icon, show/hide based on section open state. -->
                                                <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                </svg>
                                                <!-- Collapse icon, show/hide based on section open state. -->
                                                <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </button>
                                    </h3>
                                    <!-- Filter section, show/hide based on section state. -->
                                    <div x-show="expanded" class="pt-6" id="filter-section-mobile-2">
                                        <div class="space-y-6">
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-0" name="sorting" value="0"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-0"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Newest</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-1" name="sorting" value="1"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-1"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Price: Low to
                                                    High</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-mobile-size-2" name="sorting" value="2"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-mobile-size-2"
                                                    class="ml-3 min-w-0 flex-1 text-gray-500">Price: High to
                                                    Low</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5">
                                    <button type="submit"
                                        class="w-full rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
                    <div class="flex items-baseline justify-between border-gray-200 pt-20 lg:pt-0">
                        <div class="flex-1"></div> <!-- Menambahkan elemen ini untuk mengambil ruang yang tersisa -->
                        <div x-data="{ isOpen: false }" class="flex justify-end ml-auto">
                            {{-- button mobile --}}
                            <button @click="test = true" type="button"
                                class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden">
                                <span class="sr-only">Filters</span>
                                <svg class="h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <section aria-labelledby="products-heading" class="pb-5 pt-0 lg:pt-3">
                        <h2 id="products-heading" class="sr-only">Products</h2>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-1">
                            <!-- Filters -->
                            <div class="hidden lg:block w-full">
                                @csrf
                                <div class=" flex justify-between px-12">
                                    <h3 class="sr-only">Categories</h3>
                                    <div x-data="{ expanded: false }" class="border-gray-200 py-6 block w-40">
                                        <h3 class="-my-3 flow-root">
                                            <!-- Expand/collapse section button -->
                                            <button @click="expanded = ! expanded" type="button"
                                                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                                aria-controls="filter-section-0" aria-expanded="false">
                                                <span class="font-medium text-gray-900">Color</span>
                                                <span class="ml-6 flex items-center">

                                                    <!-- Expand icon, show/hide based on section open state. -->
                                                    <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>
                                                    <!-- Collapse icon, show/hide based on section open state. -->
                                                    <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h3>
                                        <!-- Filter section, show/hide based on section state. -->
                                        <div x-show="expanded" class="pt-1 border z-10 rounded-md shadow w-full mt-1"
                                            id="filter-section-0">

                                            <div class="space-y-4 px-3 py-2">
                                                <div class="flex items-center">
                                                    <input id="filter-color-0" name="color" value="white"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-0"
                                                        class="ml-3 text-sm text-gray-600">White</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-color-1" name="color" value="beige"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-1"
                                                        class="ml-3 text-sm text-gray-600">Beige</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-color-2" name="color" value="blue"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-2"
                                                        class="ml-3 text-sm text-gray-600">Blue</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-color-3" name="color" value="brown"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-3"
                                                        class="ml-3 text-sm text-gray-600">Brown</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-color-4" name="color" value="green"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-4"
                                                        class="ml-3 text-sm text-gray-600">Green</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-color-5" name="color" value="purple"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-color-5"
                                                        class="ml-3 text-sm text-gray-600">Purple</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div x-data="{ expanded: false }" class=" border-gray-200 py-6 block w-40">
                                        <h3 class="-my-3 flow-root">
                                            <!-- Expand/collapse section button -->
                                            <button @click="expanded = ! expanded" type="button"
                                                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                                aria-controls="filter-section-1" aria-expanded="false">
                                                <span class="font-medium text-gray-900">Type</span>
                                                <span class="ml-6 flex items-center">
                                                    <!-- Expand icon, show/hide based on section open state. -->
                                                    <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>
                                                    <!-- Collapse icon, show/hide based on section open state. -->
                                                    <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h3>
                                        <!-- Filter section, show/hide based on section state. -->
                                        <div x-show="expanded" class="pt-1 border z-10 rounded-md shadow w-full mt-1"
                                            id="filter-section-1">

                                            <div class="space-y-4 px-3 py-2">
                                                <div class="flex items-center">
                                                    <input id="filter-type-0" name="type" value="Polo"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-0"
                                                        class="ml-3 text-sm text-gray-600">Polo</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-1" name="type" value="Turtleneck"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-1"
                                                        class="ml-3 text-sm text-gray-600">Turtleneck</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-2" name="type" value="Plain t-shirt"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-2"
                                                        class="ml-3 text-sm text-gray-600">Plain
                                                        t-shirt</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-3" name="type" value="Wallet"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-3"
                                                        class="ml-3 text-sm text-gray-600">Wallet</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-4" name="type" value="Hoodie"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-4"
                                                        class="ml-3 text-sm text-gray-600">Hoodie</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-4" name="type" value="Pants"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-4"
                                                        class="ml-3 text-sm text-gray-600">Pants</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-4" name="type" value="Caps"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-4"
                                                        class="ml-3 text-sm text-gray-600">Caps</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-4" name="type" value="Shirt"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-4"
                                                        class="ml-3 text-sm text-gray-600">Shirt</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-type-4" name="type" value="Sweater"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-type-4"
                                                        class="ml-3 text-sm text-gray-600">Sweater</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div x-data="{ expanded: false }" class=" border-gray-200 py-6 block w-40">
                                        <h3 class="-my-3 flow-root">
                                            <!-- Expand/collapse section button -->
                                            <button @click="expanded = ! expanded" type="button"
                                                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                                aria-controls="filter-section-2" aria-expanded="false">
                                                <span class="font-medium text-gray-900">Size</span>
                                                <span class="ml-6 flex items-center">
                                                    <!-- Expand icon, show/hide based on section open state. -->
                                                    <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>
                                                    <!-- Collapse icon, show/hide based on section open state. -->
                                                    <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h3>
                                        <!-- Filter section, show/hide based on section state. -->
                                        <div x-show="expanded" class="pt-1 border z-10 rounded-md shadow w-full mt-1"
                                            id="filter-section-2">
                                            <div class="space-y-4 px-3 py-2">
                                                <div class="flex items-center">
                                                    <input id="filter-size-0" name="size" value="S"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-0"
                                                        class="ml-3 text-sm text-gray-600">S</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-1" name="size" value="M"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-1"
                                                        class="ml-3 text-sm text-gray-600">M</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-2" name="size" value="L"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-2"
                                                        class="ml-3 text-sm text-gray-600">L</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-3" name="size" value="XL"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-3"
                                                        class="ml-3 text-sm text-gray-600">XL</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-4" name="size" value="XXL"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-4"
                                                        class="ml-3 text-sm text-gray-600">XXL</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-data="{ expanded: false }" class=" border-gray-200 py-6 block w-40">
                                        <h3 class="-my-3 flow-root">
                                            <!-- Expand/collapse section button -->
                                            <button @click="expanded = ! expanded" type="button"
                                                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                                aria-controls="filter-section-2" aria-expanded="false">
                                                <span class="font-medium text-gray-900">Sort</span>
                                                <span class="ml-6 flex items-center">
                                                    <!-- Expand icon, show/hide based on section open state. -->
                                                    <svg x-show="!expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                                    </svg>
                                                    <!-- Collapse icon, show/hide based on section open state. -->
                                                    <svg x-show="expanded" class="h-5 w-5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h3>
                                        <!-- Filter section, show/hide based on section state. -->
                                        <div x-show="expanded" class="pt-1 border z-10 rounded-md shadow w-full mt-1"
                                            id="filter-section-2">
                                            <div class="space-y-4 px-3 py-2">
                                                <div class="flex items-center">
                                                    <input id="filter-size-0" name="sorting" value="0"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-0"
                                                        class="ml-3 text-sm text-gray-600">Newest</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-1" name="sorting" value="1"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-1"
                                                        class="ml-3 text-sm text-gray-600">Price:
                                                        Low to
                                                        High</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="filter-size-2" name="sorting" value="2"
                                                        type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="filter-size-2"
                                                        class="ml-3 text-sm text-gray-600">Price:
                                                        High to
                                                        Low</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="color" name="color">
                                    <input type="hidden" id="size" name="size">
                                    <input type="hidden" id="type" name="type">
                                    <div class="">
                                        <button type="submit"
                                            class="mt-3 w-40 rounded-md border border-transparent bg-green-600 px-8 py-2 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </form>

        <script>
            // Ambil semua kotak centang dengan nama 'sorting'
            var sortingCheckboxes = document.querySelectorAll('input[name="sorting"]');

            sortingCheckboxes.forEach(function(checkbox) {
                // Tambahkan event listener pada setiap kotak centang
                checkbox.addEventListener('change', function() {
                    // Jika kotak centang ini dicentang
                    if (this.checked) {
                        // Nonaktifkan kotak centang lainnya
                        sortingCheckboxes.forEach(function(otherCheckbox) {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.disabled = true;
                            }
                        });
                    } else {
                        // Jika kotak centang ini tidak dicentang, aktifkan kembali kotak centang lainnya
                        sortingCheckboxes.forEach(function(otherCheckbox) {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.disabled = false;
                            }
                        });
                    }
                });
            });

            // Tambahkan event listener pada setiap kotak centang untuk mendeteksi perubahan
            document.querySelectorAll('input[name="color"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateHiddenInputValues('color');
                });
            });

            document.querySelectorAll('input[name="size"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateHiddenInputValues('size');
                });
            });

            document.querySelectorAll('input[name="type"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateHiddenInputValues('type');
                });
            });

            function updateHiddenInputValues(attribute) {
                // Dapatkan semua kotak centang yang dicentang
                var checkedCheckboxes = document.querySelectorAll('input[name="' + attribute + '"]:checked');

                // Ambil nilai dari kotak centang yang dicentang dan gabungkan menjadi satu string
                var values = Array.from(checkedCheckboxes).map(function(checkbox) {
                    return checkbox.value;
                });

                // Perbarui nilai dari variabel $color atau $size
                if (attribute === 'color') {
                    document.getElementById('color').value = values.join(',');
                } else if (attribute === 'size') {
                    document.getElementById('size').value = values.join(',');
                } else if (attribute === 'type') {
                    document.getElementById('type').value = values.join(',');
                }
            }
        </script>

        <!-- Product grid -->
        <div class="lg:col-span-full px-3 mb-5">
            <div class="container mx-auto p-0.5">
                <h1 class="text-center text-2xl font-bold mb-4">Data Pakaian</h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border text-center">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Image</th>
                                <th class="px-4 py-2 border">Type</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Size</th>
                                <th class="px-4 py-2 border">Color</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">Quantity</th>
                                <th class="px-4 py-2 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clothes as $cloth)
                                <tr class="bg-gray-100 even:bg-gray-200">
                                    <td class="px-4 py-2 border">
                                        <img src="{{ $cloth['image_url'] }}" alt="Cloth Image"
                                            class="max-w-24 max-h-24 mx-auto">
                                    </td>
                                    <td class="px-4 py-2 border">{{ $cloth['type'] }}</td>
                                    <td class="px-4 py-2 border">{{ $cloth['name'] }}</td>
                                    <td class="px-4 py-2 border">{{ $cloth['size'] }}</td>
                                    <td class="px-4 py-2 border">{{ $cloth['color'] }}</td>
                                    <td class="px-4 py-2 border">
                                        Rp{{ formatRupiah($cloth['price_per_piece']) }}</td>
                                    <td class="px-4 py-2 border">{{ $cloth['description'] }}</td>
                                    <td class="px-4 py-2 border">{{ $cloth['total_quantity'] }}</td>
                                    <td class="px-4 py-2 border">
                                        <button>
                                            <a href="/clothes/data/{{ $cloth['id'] }}"
                                                class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Edit</a>
                                        </button>
                                        <div x-data="{ deletee: false }">
                                            <form action="/clothes/delete/{{ $cloth['id'] }}" method="GET"
                                                class="inline-block">
                                                @csrf
                                                <button type="button" @click="deletee = true"
                                                    class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                                @include('modal.modal_delete')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 justify-between">
                    {{ $clothes->links() }}
                </div>
                <div class="mt-6 flex justify-between">
                    <a href="/dashboard"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
                    <a href="/dashboard/data_pakaian/tambah"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
