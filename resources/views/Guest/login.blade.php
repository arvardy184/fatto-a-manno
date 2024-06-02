<!DOCTYPE html>
<html lang="en" class="min-h-screen bg-white scroll-smooth">

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

<body class="h-full">
    <div class="min-h-full">
        <div class="min-h-full">
            <nav class="bg-gray-800" x-data="{ isOpen: false }">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <img class="w-40" src="{{ asset('images/logo.png') }}" alt="Your Company">
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                                    <a href="/"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                                </div>
                            </div>
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                                    <a href="/all_products"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">All
                                        Products</a>
                                </div>
                            </div>
                        </div>
                        <div class="-mr-2 flex md:hidden">
                            <!-- Mobile menu button -->
                            <button type="button" @click="isOpen = !isOpen"
                                class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                aria-controls="mobile-menu" aria-expanded="false">
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">Open main menu</span>
                                <!-- Menu open: "hidden", Menu closed: "block" -->
                                <svg :class="{ 'hidded': isOpen, 'block': !isOpen }" class="block h-6 w-6"
                                    fill="none" Box="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <!-- Menu open: "block", Menu closed: "hidden" -->
                                <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6"
                                    fill="none" Box="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div x-show="isOpen" class="md:hidden" id="mobile-menu">
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="/"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Dashboard</a>
                    </div>
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                        <a href="/all_products"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">All
                            Product</a>
                    </div>
                </div>
            </nav>
        </div>
        <main>
            <div class="relative bg-gray-900"><img src="{{ asset('images/login.png') }}"
                    class="opacity-60 object-cover object-right  relative lg:h-[42.4rem] h-[77.2rem] md:h-[95.1vh] w-full "
                    alt="">
                <div class="absolute inset-0 mx-auto max-w-7xl sm:px-6 lg:px-8 p-1">
                    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                        <div
                            class="mt-3 sm:mx-auto sm:w-full sm:max-w-sm border border-black p-5 bg-slate-200 rounded-lg">
                            <!-- Check for a global error message -->
                            @if (session('errors'))
                                @include('components.view_modal')
                            @endif
                            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                                    Sign in to your account
                                </h2>
                            </div>
                            <form class="space-y-6" action="/signin" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <input type="email" id="email" name="email" required
                                        class="mt-1 block w-full px-3 py-2 border border-black bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="name@example.com">
                                </div>
                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" id="password" name="password" required
                                        class="mt-1 block w-full px-3 py-2 border border-black bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        placeholder="Password">
                                </div>
                                <div class="text-sm text-end">
                                    <a href="/forgotPass"
                                        class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot
                                        password?</a>
                                </div>
                                <div x-data="{ back: false }">
                                    <button @click="back = true" type="submit"
                                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                        Sign in
                                    </button>
                                </div>
                            </form>
                            <p class="mt-10 text-center text-sm text-gray-500">
                                Don't have an account yet?
                                <a href="/register"
                                    class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
