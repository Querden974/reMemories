@extends('base')
@section('title', 'Login')
@section('content')
    <div class="mt-32">
        <div class="mx-auto max-w-screen-xl px-4  sm:px-6 lg:px-8">
            <div class="mx-auto max-w-lg">



                <form action="" method="post"
                    class="bg-component mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                    @csrf
                    <h1 class="text-center text-2xl font-bold text-primary sm:text-3xl">Sign in to your account</h1>

                    <div>
                        <label for="name" class="sr-only">Pseudo</label>

                        <div class="relative">
                            <input type="text" name="name"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter pseudo" value="{{ old('name') }}" required />

                            <span class="select-none absolute inset-y-0 end-0 grid place-content-center px-4">
                                <span class="material-symbols-outlined text-gray-400 p-1">
                                    person
                                </span>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>

                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter password" required />

                            <span id="password-visibility"
                                class="select-none cursor-pointer absolute inset-y-0 end-0 grid place-content-center px-4">
                                <span
                                    class="material-symbols-outlined text-gray-400 border-2 border-primary rounded-full p-1">
                                    visibility_off
                                </span>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="block w-full rounded-lg bg-primary px-5 py-3 text-sm font-medium text-background">
                        Sign in
                    </button>

                    <p class="text-center text-sm text-gray-200">
                        No account?
                        <a class="underline" href="/register">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        const password_visibility = document.getElementById('password-visibility');
        const password = document.getElementById('password');
        password_visibility.addEventListener('click', function() {
            if (password.type === 'password') {
                password.type = 'text';
                password_visibility.innerHTML = `
                <span class="material-symbols-outlined text-bachground border-2 border-primary bg-primary rounded-full p-1">
                    visibility
                </span>
                `;
            } else {
                password.type = 'password';
                password_visibility.innerHTML = `
                <span class="material-symbols-outlined text-gray-400 border-2 border-primary rounded-full p-1">
                    visibility_off
                </span>
                `;
            }
        });
    </script>
@endsection
