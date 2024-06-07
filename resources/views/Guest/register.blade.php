<!DOCTYPE html>
<html lang="en" class=" bg-white scroll-smooth">

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

    <nav class="bg-gray-800 p-1" x-data="{ isOpen: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <img class="w-40" src="{{ asset('images/logo.png') }}" alt="Your Company">
                    @if (!request()->routeIs('dashboard'))
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="/"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                            </div>
                        </div>
                    @endif
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
                @if (!request()->routeIs('login'))
                    <div id="login" class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <div
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                <a id="login" href="/login"
                                    class="text-sm font-semibold leading-6 text-slate-100">Log in<span
                                        aria-hidden="true">&rarr;</span></a>
                            </div>
                        </div>
                    </div>
                @endif
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
            @if (!request()->routeIs('dashboard'))
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="/"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Dashboard</a>
                </div>
            @endif
            @if (!request()->routeIs('All Products'))
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                    <a href="/all_products"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">All
                        Product</a>
                </div>
            @endif
            @if (!request()->routeIs('login'))
                <div id="login" class="border-t border-gray-700 pb-3 pt-4">
                    <div
                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                        <a href="/login" class="text-sm font-semibold leading-6 text-slate-100">Log in<span
                                aria-hidden="true">&rarr;</span></a>
                    </div>
                </div>
            @endif
        </div>
    </nav>
    <main>
        <div>

            <div class="relative bg-gray-900  "><img
                    src="https://malangposcomedia.id/mpm/uploads/2022/06/ilham-fatto-a-mano2-1-1392x928.jpg"
                    class="opacity-60 object-cover object-right h-[90.3vh] relative w-full" alt="">
                <div class="absolute inset-0 flex items-center justify-center">

                    <div class="absolute inset-0 tems-center flex h-full flex-col justify-center px-5 ">
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm border border-black bg-slate-200 rounded-lg">
                            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                                    Sign in to your account
                                </h2>
                            </div>
                            @if (session('errors'))
                                @include('components.view_modal')
                            @endif
                            <form class="space-y-1 p-5" action="/signup" method="POST">
                                @csrf
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full
                                        Name</label>
                                    <input type="text" id="name" name="name"
                                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Muhammad Zakki Islami">
                                </div>
                                <div class="mb-4">
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Password">
                                </div>
                                <div class="mb-4">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="name@example.com">
                                </div>
                                <div class="mb-4">
                                    <label for="address"
                                        class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" id="address" name="address"
                                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Jl">
                                </div>
                                <div class="mb-4">
                                    <label for="number" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input type="text" id="number" name="number"
                                        class="mt-1 block w-full px-3 py-2 border border-black rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="08xxxxxx">
                                </div>
                                <div x-data="{ back: false }" class="space-y-2">
                                    <button @click="back = true" type="submit"
                                        class="mt-3 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Register
                                    </button>
                                    <a href="{{ url()->previous() }}"
                                        class="flex w-full justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                                        Back
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    @include('components.footer')
</body>

</html>
