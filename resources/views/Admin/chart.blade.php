{{-- kalau bulan nya 0, berarti filter nya pertahun --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container p-3 mx-auto">
        <!-- Form Filter -->
        <form action="/admin/analyze" method="POST">
            @csrf
            <div class="grid grid-cols-4 gap-4 mb-4">
                <!-- Type Baju -->
                <div>
                    <label for="clothes_type" class="block">Color</label>
                    <select name="clothes_color" id="clothes_type" size="1"
                        class="block w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value=""></option>
                        <option value="white">White</option>
                        <option value="black">Black</option>
                        <option value="blue">Blue</option>
                        <option value="brown">Brown</option>
                        <option value="sage">Sage</option>
                    </select>
                </div>
                <div>
                    <label for="clothes_type" class="block">Type</label>
                    <select name="clothes_type" id="clothes_type" size="1"
                        class="block w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value=""></option>
                        <option value="polo">Polo</option>
                        <option value="turtleneck">Turtleneck</option>
                        <option value="kaos polos">Plain t-shirt</option>
                        <option value="wallet">Wallet</option>
                        <option value="hoodie">Hoodie</option>
                        <option value="pants">Pants</option>
                        <option value="caps">Caps</option>
                        <option value="kemeja">Kemeja</option>
                        <option value="sweater">Sweater</option>
                    </select>
                </div>
                <!-- Bulan -->
                <div>
                    <label for="month" class="block">Bulan</label>
                    <select name="month" id="month" size="1"
                        class="block w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="0"></option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>

                        <!-- Masukkan pilihan bulan dari Januari hingga Desember -->
                    </select>
                </div>
                <!-- Tahun -->
                <div>
                    <label for="year" class="block">Tahun</label>
                    <select name="year" id="year" size="1"
                        class="block w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value=""></option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <!-- Masukkan pilihan tahun -->
                    </select>
                </div>
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold mb-3   py-2 px-4 rounded">Filter</button>
        </form>

        <!-- Chart -->
        <div class="p-1 mx-auto border border-black h-full w-full bg-white rounded shadow">
            {!! $chart->container() !!}
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</x-layout>
