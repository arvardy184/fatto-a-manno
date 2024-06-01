{{-- 1= Bayar Langsung --}}
{{-- 0=Manual --}}
{{-- 2=Masi di keranjang --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white">
        <div x-data="{ test: false }">
            @if (session('errors'))
                @include('components.view_modal')
            @endif

            {{-- mobile --}}
            <div x-show="test" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
                <div x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
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
                        <form action="{{ route('Histori User') }}" method="GET" x-show="test"
                            class="mt-4 border-t border-gray-200">
                            @csrf
                            <div x-data="{ expanded: false }" class="border-t border-gray-200 px-4 py-6">
                                <h3 class="-mx-2 -my-3 flow-root">
                                    <!-- Expand/collapse section button -->
                                    <button type="button" @click="expanded = ! expanded"
                                        class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                        aria-controls="filter-section-mobile-0" aria-expanded="false">
                                        <span class="font-medium text-gray-900">Payment Method</span>
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
                                            <input id="filter-mobile-color-0" name="payment_method" value="1"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-color-0"
                                                class="ml-3 min-w-0 flex-1 text-gray-500"> Pay without going through
                                                admin</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-color-1" name="payment_method" value="0"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-color-1"
                                                class="ml-3 min-w-0 flex-1 text-gray-500">Pay via admin</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-color-2" name="payment_method" value="2"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-color-2"
                                                class="ml-3 min-w-0 flex-1 text-gray-500"> Still in the cart</label>
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
                                        <span class="font-medium text-gray-900">Payment Status</span>
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
                                            <input id="filter-mobile-category-0" name="payment_status" value="1"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-category-0"
                                                class="ml-3 min-w-0 flex-1 text-gray-500"> Already paid</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-category-1" name="payment_status" value="0"
                                                type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-category-1"
                                                class="ml-3 min-w-0 flex-1 text-gray-500"> Not yet paid</label>
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
                                        <span class="font-medium text-gray-900">Confirmation Status</span>
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
                                            <input id="filter-mobile-size-0" name="confirmation_status"
                                                value="1" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-size-0"
                                                class="ml-3 min-w-0 flex-1 text-gray-500"> Has been confirmed</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-size-1" name="confirmation_status"
                                                value="0" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-size-1"
                                                class="ml-3 min-w-0 flex-1 text-gray-500">Has not been
                                                confirmed</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="filter-mobile-size-2" name="confirmation_status"
                                                value="2" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="filter-mobile-size-2"
                                                class="ml-3 min-w-0 flex-1 text-gray-500">Canceled</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="payment_method" name="payment_method">
                            <input type="hidden" id="confirmation_status" name="confirmation_status">
                            <input type="hidden" id="payment_status" name="payment_status">
                            <div class="px-5">
                                <button type="submit"
                                    class="w-full rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Submit</button>
                            </div>
                        </form>
                        <script>
                            var paymentStatusCheckboxes = document.querySelectorAll('input[name="payment_status"]');
                            var confirmationStatusCheckboxes = document.querySelectorAll('input[name="confirmation_status"]');
                            var paymentMethodCheckboxes = document.querySelectorAll('input[name="payment_method"]');

                            paymentStatusCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        paymentStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        paymentStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });

                            confirmationStatusCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        confirmationStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        confirmationStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });

                            paymentMethodCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        paymentMethodCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        paymentMethodCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>

            <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 ">
                <div class="flex items-baseline justify-between border-gray-200 pb-6 pt-24 lg:pt-0">
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

                <section aria-labelledby="products-heading" class="pb-24 pt-0 lg:pt-3">
                    <h2 id="products-heading" class="sr-only">Products</h2>

                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-1">
                        <!-- Filters -->
                        <form action="{{ route('Histori User') }}" method="GET" class="hidden lg:block w-full">
                            @csrf
                            <div class=" flex justify-between px-12">
                                <h3 class="sr-only">Categories</h3>
                                <div x-data="{ expanded: false }" class="border-gray-200 py-6 block w-52">
                                    <h3 class="-my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button @click="expanded = ! expanded" type="button"
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Payment Method</span>
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
                                    <div x-show="expanded" class="pt-6" id="filter-section-0">
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <input id="filter-color-0" name="payment_method" value="1"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-color-0" class="ml-3 text-sm text-gray-600"> Pay
                                                    without going through
                                                    admin</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-color-1" name="payment_method" value="0"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-color-1" class="ml-3 text-sm text-gray-600">Pay via
                                                    admin</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-color-2" name="payment_method" value="2"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-color-2" class="ml-3 text-sm text-gray-600">Still
                                                    in the cart</label>
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
                                            <span class="font-medium text-gray-900">Payment Status</span>
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
                                    <div x-show="expanded" class="pt-6" id="filter-section-1">
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <input id="filter-category-0" name="payment_status" value="1"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-category-0" class="ml-3 text-sm text-gray-600">
                                                    Already paid</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-category-1" name="payment_status" value="0"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-category-1" class="ml-3 text-sm text-gray-600">
                                                    Not yet paid</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ expanded: false }" class=" border-gray-200 py-6 block w-48">
                                    <h3 class="-my-3 flow-root">
                                        <!-- Expand/collapse section button -->
                                        <button @click="expanded = ! expanded" type="button"
                                            class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-2" aria-expanded="false">
                                            <span class="font-medium text-gray-900">Confirmation Status</span>
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
                                    <div x-show="expanded" class="pt-6" id="filter-section-2">
                                        <div class="space-y-4">
                                            <div class="flex items-center">
                                                <input id="filter-size-0" name="confirmation_status" value="1"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-size-0" class="ml-3 text-sm text-gray-600">Has been
                                                    confirmed</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-size-1" name="confirmation_status" value="0"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-size-1" class="ml-3 text-sm text-gray-600">Has not
                                                    been confirmed</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="filter-size-2" name="confirmation_status" value="2"
                                                    type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <label for="filter-size-2" class="ml-3 text-sm text-gray-600">
                                                    Canceled</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="payment_method" name="payment_method">
                                <input type="hidden" id="confirmation_status" name="confirmation_status">
                                <input type="hidden" id="payment_status" name="payment_status">
                                <div class="block">
                                    <button type="submit"
                                        class="mt-3 w-40 rounded-md border border-transparent bg-green-600 px-8 py-2 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                        <script>
                            var paymentStatusCheckboxes = document.querySelectorAll('input[name="payment_status"]');
                            var confirmationStatusCheckboxes = document.querySelectorAll('input[name="confirmation_status"]');
                            var paymentMethodCheckboxes = document.querySelectorAll('input[name="payment_method"]');

                            paymentStatusCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        paymentStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        paymentStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });

                            confirmationStatusCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        confirmationStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        confirmationStatusCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });

                            paymentMethodCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        paymentMethodCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = true;
                                            }
                                        });
                                    } else {
                                        paymentMethodCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.disabled = false;
                                            }
                                        });
                                    }
                                });
                            });
                        </script>


                        <!-- Product grid -->
                        <div class="lg:col-span-full">
                            <div class="container mx-auto">
                                <h1 class="text-center text-2xl font-bold mb-4">History {{ auth()->user()->name }}</h1>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border text-center text-xs">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 border">Image</th>
                                                <th class="px-4 py-2 border">Name</th>
                                                <th class="px-4 py-2 border">Size</th>
                                                <th class="px-4 py-2 border">Type</th>
                                                <th class="px-4 py-2 border">Unity Price</th>
                                                <th class="px-4 py-2 border">Total number of item(s)</th>
                                                <th class="px-4 py-2 border">Total price</th>
                                                <th class="px-4 py-2 border">Payment Method</th>
                                                <th class="px-4 py-2 border">Payment Status</th>
                                                <th class="px-4 py-2 border">Confirmation Status</th>
                                                <th class="px-4 py-2 border">Transaction Date</th>
                                                <th class="px-4 py-2 border">Payment URL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($buys as $buy)
                                                <tr class="bg-gray-100 even:bg-gray-200">
                                                    <td class="px-4 py-2 border"><img
                                                            src="{{ $buy->cloth->image_url }}"
                                                            class="max-w-24 max-h-24 mx-auto" alt=""></td>
                                                    <td class="px-4 py-2 border">{{ $buy->cloth->name }}</td>
                                                    <td class="px-4 py-2 border">{{ $buy->cloth->size }}</td>
                                                    <td class="px-4 py-2 border">{{ $buy->cloth->type }}</td>
                                                    <td class="px-4 py-2 border">
                                                        Rp{{ formatRupiah($buy->cloth->price_per_piece) }}</td>
                                                    <td class="px-4 py-2 border">{{ $buy->quantity }}</td>
                                                    <td class="px-4 py-2 border">
                                                        Rp{{ formatRupiah($buy->total_price) }}</td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($buy->payment_method == 1)
                                                            Pay without going through admin
                                                        @elseif ($buy->payment_method == 0)
                                                            Pay via admin
                                                        @else
                                                            Still in the cart
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($buy->payment_status == 1)
                                                            Already paid
                                                        @else
                                                            Not yet paid
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($buy->confirmation_status == 1)
                                                            Has been confirmed
                                                        @elseif($buy->confirmation_status == 0)
                                                            Has not been confirmed
                                                        @else
                                                            Canceled
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border">{{ $buy->user->created_at }} </td>
                                                    @if ($buy->payment_url != null)
                                                        <td class="px-4 py-2 border">
                                                            <button
                                                                class="inline-block mt-2 w-full px-4 py-2 text-xs font-semibold leading-6 text-white uppercase bg-yellow-600 rounded hover:bg-yellow-700 focus:outline-none focus:bg-yellow-700">
                                                                <a href="{{ $buy->payment_url }}">URL</a></button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 justify-between">
                                    {{ $buys->links() }}
                                </div>
                                <a href="/dashboard"
                                    class="block mb-5 w-full max-w-xs mx-auto mt-4 px-4 py-2 border text-sm font-semibold leading-6 text-center text-white uppercase bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Back</a>
                            </div>
                        </div>

                    </div>
                </section>
            </main>
        </div>
    </div>

</x-layout>
