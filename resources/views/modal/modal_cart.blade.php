{{-- modal belum login --}}
<div x-show="pilihPembayaran" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100 " x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    {{-- isi modal --}}
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-center sm:justify-center">
                        <div class="text-center sm:ml-4 sm:mt-0">
                            <form id="formBayarLangsung1" method="POST" action="/buy/cart/buy">
                                @csrf
                                <input type="hidden" name="buys_id" value="{{ implode(',', $pembayaran) }}">
                                <input type="hidden" name="total_price" value="{{ $sum }}">
                                <input type="hidden" name="payment_method" value="0">
                                <button type="submit"
                                    class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-1 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Bayar
                                    Melalui Admin</button>
                            </form>
                        </div>
                        <div class="text-center sm:ml-4 sm:mt-0">
                            <form id="formBayarLangsung2" method="POST" action="/buy/cart/buy">
                                @csrf
                                <input type="hidden" name="buys_id" value="{{ implode(',', $pembayaran) }}">
                                <input type="hidden" name="total_price" value="{{ $sum }}">
                                <input type="hidden" name="payment_method" value="1">
                                <button type="submit"
                                    class="sm:mt-0 mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-yellow-600 px-8 py-1 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Bayar
                                    Tanpa Melalui Admin</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button @click="pilihPembayaran = false" type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('formBayarLangsung1').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Submit the form programmatically
        this.submit();
    });

    document.getElementById('formBayarLangsung2').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Submit the form programmatically
        this.submit();
    });
</script>
