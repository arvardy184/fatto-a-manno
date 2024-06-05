@auth
    @if (auth()->user()->role_id == 1)
        {{-- Admin Start --}}
        <div class="min-h-full">
            <nav class="bg-gray-800" x-data="{ isOpen: false }">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-40" src="{{ asset('images/logo.png') }}" alt="Your Company">
                            </div>
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                    @if (!request()->routeIs('dashboard'))
                                        <a href="/dashboard"
                                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                            aria-current="page">Home</a>
                                    @endif
                                    @if (!request()->routeIs('Data Pakaian'))
                                        <form action="/dashboard/data_pakaian" method="GET" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                                Clothing Information
                                            </button>
                                        </form>
                                    @endif
                                    @if (!request()->routeIs('Data Storage'))
                                        <form action="/dashboard/data_storage" method="GET" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
                                                Storage Information
                                            </button>
                                        </form>
                                    @endif
                                    @if (!request()->routeIs('Data Pengguna'))
                                        <form action="/dashboard/data_pengguna" method="GET" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">

                                                User Information
                                            </button>
                                        </form>
                                    @endif
                                    @if (!request()->routeIs('Sales Analysis'))
                                        <form action="/dashboard/sales_analysis" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">

                                                Sales Analysis
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-4 flex items-center md:ml-6">
                                <!-- Profile dropdown -->
                                <div class="relative ml-3">
                                    <button type="button" @click="isOpen = !isOpen"
                                        onclick="document.getElementById('dropdown-profile').classList.remove('hidden')"
                                        class="relative flex max-w-xs items-center  text-sm" id="user-menu-button"
                                        aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <h1 class="text-white">{{ auth()->user()->name }} <i
                                                class="fa-solid fa-chevron-down" style="color: #ffffff;"></i></h1>
                                    </button>
                                    <div x-show="isOpen" @click.away="isOpen=false"
                                        x-transition:enter="transition ease-out duration-100 transform"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75 transform"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95" id="dropdown-profile"
                                        class="absolute hidden right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @if (!request()->routeIs('Profile'))
                                            <a href="/dashboard/profile"
                                                class="block px-4 py-2 text-sm hover:bg-slate-200 text-gray-700 hover:text-black"
                                                role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                        @endif
                                        <a href="/logout"
                                            class="block px-4 py-2 text-sm hover:bg-slate-200 text-gray-700 hover:text-black"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-mr-2 flex md:hidden">
                            <!-- isOpen menu button -->
                            <button type="button" @click="isOpen = !isOpen"
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
                <div x-show="isOpen" class="md:hidden" id="isOpen-menu">
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        @if (!request()->routeIs('dashboard'))
                            <a href="/dashboard"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                                aria-current="page">Home</a>
                        @endif
                        @if (!request()->routeIs('Data Pakaian'))
                            <form action="/dashboard/data_pakaian" method="GET" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                                    Clothing information
                                </button>
                            </form>
                        @endif
                        @if (!request()->routeIs('Data Storage'))
                            <form action="/dashboard/data_storage" method="GET" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                                    Storage Information
                                </button>
                            </form>
                        @endif
                        @if (!request()->routeIs('Data Pengguna'))
                            <form action="/dashboard/data_pengguna" method="GET" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                                    User Information
                                </button>
                            </form>
                        @endif
                        @if (!request()->routeIs('Sales Analysis'))
                            <form action="/dashboard/sales_analysis" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                                    Sales Analysis
                                </button>
                            </form>
                        @endif

                    </div>
                    <div class="border-t border-gray-700 pb-3 pt-4">
                        <div class="flex items-center px-5">
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                                <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            @if (!request()->routeIs('Profile'))
                                <a href="/dashboard/profile"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                                    Profile</a>
                            @endif
                            <a href="/logout"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                                out</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        {{-- Admin End --}}
    @else
        {{-- User Start --}}
        <div x-data="{ isOpen: false }" class="min-h-full">
            <nav x-data="{ isOpen: false }" class="bg-gray-800">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-40" src="{{ asset('images/logo.png') }}" alt="Your Company">
                            </div>
                            @if (!request()->routeIs('dashboard'))
                                <div class="hidden md:block">
                                    <div class="ml-10 flex items-baseline space-x-4">
                                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                        <a href="/dashboard"
                                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                            aria-current="page">Home</a>
                                    </div>
                                </div>
                            @endif

                            @if (!request()->routeIs('Histori User'))
                                <div class="hidden md:block">
                                    <div class="ml-10 flex items-baseline space-x-4">
                                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                        <a href="/dashboard/histori_user"
                                            class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                            aria-current="page">Transaction History </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="hidden md:block">
                            <div class="ml-4 flex items-center md:ml-6">
                                @if (!request()->routeIs('Keranjang User'))
                                    <div x-data="{ cartt: false }" class="relative ml-auto flex-shrink-0 rounded-full">
                                        <button onclick="document.getElementById('cartLg').classList.remove('hidden')"
                                            id="cartLg_button" @click="cartt = true" type="button">
                                            <i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></button>
                                        @include('modal.cartLg')
                                    </div>
                                @endif

                                <!-- Profile dropdown -->
                                <div class="relative ml-3">
                                    <button type="button" @click="isOpen = !isOpen"
                                        onclick="document.getElementById('dropdown-profile').classList.remove('hidden')"
                                        class="relative flex max-w-xs items-center  text-sm" id="user-menu-button"
                                        aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <h1 class="text-white">{{ auth()->user()->name }} <i
                                                class="fa-solid fa-chevron-down" style="color: #ffffff;"></i></h1>
                                    </button>
                                    <div x-show="isOpen" @click.away="isOpen=false"
                                        x-transition:enter="transition ease-out duration-100 transform"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75 transform"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95" id="dropdown-profile"
                                        class="absolute hidden right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1">
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        @if (!request()->routeIs('Profile'))
                                            <a href="/dashboard/profile"
                                                class="block px-4 py-2 text-sm hover:bg-slate-200 text-gray-700 hover:text-black"
                                                role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                        @endif
                                        <a href="/logout"
                                            class="block px-4 py-2 text-sm hover:bg-slate-200 text-gray-700 hover:text-black"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-mr-2 md:hidden">
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
                <div x-show="isOpen" class="hidden md:hidden" id="isOpen-menu">
                    @if (!request()->routeIs('dashboard'))
                        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/dashboard"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                                aria-current="page">Home</a>
                        </div>
                    @endif

                    @if (!request()->routeIs('Histori User'))
                        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/dashboard/histori_user"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                                aria-current="page">Transaction History </a>
                        </div>
                    @endif

                    <div class="border-t border-gray-700 pb-3 pt-4">
                        <div class="flex items-center px-5">
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}
                                </div>
                                <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}
                                </div>
                            </div>
                            @if (!request()->routeIs('Keranjang User'))
                                <div x-data="{ cartt: false }" class="relative ml-auto flex-shrink-0 rounded-full">
                                    <button onclick="document.getElementById('cartMd').classList.remove('hidden')"
                                        id="cartMD_button" @click="cartt = true" type="submit">
                                        <i class="fa-solid fa-cart-shopping" style="color: #ffffff;"></i></button>
                                    @include('modal.cartMd')
                                </div>
                            @endif
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            @if (!request()->routeIs('Profile'))
                                <a href="/dashboard/profile"
                                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                                    Profile</a>
                            @endif
                            <a href="/logout"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                                out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                function formatRupiah(angka, prefix) {
                    var number_string = angka.toString().replace(/[^,\d]/g, ''),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        var separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }

                $(document).ready(function() {
                    // Handler for large cart modal
                    $('#cartLg_button').on('click', function(e) {
                        e.preventDefault();
                        fetchCartData('.cartLg-container ul', '#subtotal-price-lg');
                    });

                    // Handler for medium cart modal
                    $('#cartMD_button').on('click', function(e) {
                        e.preventDefault();
                        fetchCartData('.cartMD-container ul', '#subtotal-price-md');
                    });
                });

                function fetchCartData(cartContainerSelector, subtotalContainerSelector) {
                    $.ajax({
                        url: '/buy/cart/view',
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (Array.isArray(data['buys'])) {
                                const cartContainer = $(cartContainerSelector);
                                const subtotalContainer = $(subtotalContainerSelector);
                                cartContainer.empty();
                                let subtotal = 0;

                                data['buys'].forEach(function(element) {
                                    const formattedPrice = formatRupiah(element.cloth.price_per_piece);
                                    const totalItemPrice = element.cloth.price_per_piece * element.quantity;
                                    subtotal += totalItemPrice;

                                    const itemHTML = `
                            <li class="flex py-6">
                              <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                <img src="${element.cloth.image_url}" alt="" class="h-full w-full object-cover object-center">
                              </div>
                              <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                  <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3>${element.cloth.name}</h3>
                                    <p class="ml-4">Rp${formattedPrice}</p>
                                  </div>
                                  <p class="mt-1 text-sm text-gray-500">${element.cloth.color}</p>
                                </div>
                                <div class="flex flex-1 items-end justify-between text-sm">
                                  <p class="text-gray-500">Qty ${element.quantity}</p>
                                 
                                </div>
                              </div>
                            </li>`;
                                    cartContainer.append(itemHTML);
                                });

                                subtotalContainer.text('Rp' + formatRupiah(subtotal));
                            } else {
                                console.log('Invalid data format');
                            }
                        },
                        error: function(error) {
                            console.error('Error fetching cart data:', error);
                        }
                    });
                }
            </script>

        </div>
        {{-- User End --}}
    @endif
@else
    {{-- Guest Start --}}
    <div>
        <nav class="bg-gray-800 h-[10vh] p-1" x-data="{ isOpen: false }">
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
            <div x-show="isOpen" class="md:hidden" id="isOpen-menu">
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

    </div>
    {{-- Guest end --}}
@endauth
