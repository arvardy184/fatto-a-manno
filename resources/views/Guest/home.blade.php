<!DOCTYPE html>
<html lang="en" class="bg-white scroll-smooth h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/e8b5a157ee.js" crossorigin="anonymous"></script>
    <title>{{ $title }}</title>

</head>

<body>
    <div>
        <nav class="bg-gray-800 p-1" x-data="{ isOpen: false }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <img class="w-40" src="{{ asset('images/logo.png') }}" alt="Your Company">
                        @if (!request()->routeIs('All Products'))
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                                    <a href="/all_products"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">All
                                        Products</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="-mr-2 flex md:hidden">
                        <!-- isOpen menu button -->
                        <button type="button" @click="isOpen = !isOpen"
                            onclick="document.getElementById('isOpen-menu').classList.remove('hidden')"
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            aria-controls="isOpen-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- isOpen menu, show/hide based on menu state. -->
            <div x-show="isOpen" class="md:hidden hidden" id="isOpen-menu">

                @if (!request()->routeIs('All Products'))
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                        <a href="/all_products"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">All
                            Product</a>
                    </div>
                @endif

            </div>
        </nav>

    </div>
    <div class="relative bg-gray-900 ">
        <img src="{{ asset('images/home.png') }}" alt=""
            class="opacity-60 object-cover object-right  relative h-[90.3vh] w-full">

        <div
            class=" absolute inset-0 p-10 md:my-auto mt-36 mx-auto lg:max-w-2xl max-h-none h-80 items-center justify-center">
            <div class="px-5 py-10 border border-black bg-gray-800">
                <div class="mx-auto max-w-3xl lg:mx-0 text-center ">
                    <h2 class="md:text-4xl text-xl font-bold tracking-tight text-white sm:text-6xl">Fatto A Mano
                        Official
                        Shop</h2>
                    <h3 class="md:text-lg text-lg mt-2 tracking-tight text-white sm:text-xl">Your Journey, Your
                        Style.</h3>
                    <p class="mt-6 md:text-lg text-sm leading-8 text-gray-300">Jl Kadaka No. 7A, Jatimulyo, Lowokwaru,
                        Malang City, East Java</p>
                    <div class="mx-auto mt-10 max-w-2xl lg:mx-0 lg:max-w-none">
                        <div
                            class="grid grid-cols-1 gap-x-8 gap-y-6 text-base font-semibold leading-7 text-white sm:grid-cols-2 lg:flex lg:justify-center lg:gap-x-10">
                            <a href="/login">Log in <span aria-hidden="true">&rarr;</span></a>
                            <a href="/register">Register<span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')

</body>

</html>
