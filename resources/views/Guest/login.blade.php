<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-3 sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- Check for a global error message -->
            @if (session('errors'))
                @include('components.view_modal')
            @endif
            <form class="space-y-6" action="/signin" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="name@example.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Password">
                </div>
                <div class="text-sm text-end">
                    <a href="/forgotPass" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot
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
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
            </p>
        </div>
    </div>
</x-layout>
