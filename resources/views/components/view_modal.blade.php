<x-modal name="confirm-user-deletion" :show="true" focusable>
    <div class="space-y-6 p-6">
        <h2 class="text-lg font-medium text-center text-green-500 ">
            Error
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ session('errors')->first() }}
        </p>

        <div class="mt-6 flex justify-center text-white ">
            <button x-on:click="$dispatch('close')">
                {{ __('Back') }}
            </button>
        </div>
    </div>
</x-modal>
