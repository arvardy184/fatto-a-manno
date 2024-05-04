<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-1 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your
                account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control border border-black rounded" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control border border-black rounded" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="text-sm text-end">
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
            </p>
        </div>
    </div>
</x-layout>
