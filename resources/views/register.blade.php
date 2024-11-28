@extends('base')
@section('title', 'Register')
@section('content')
    <div class="mt-16">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-lg">
                <h1 class="text-center text-2xl font-bold text-primary sm:text-3xl">Get started today</h1>

                <p class="mx-auto mt-4 max-w-md text-center text-gray-300">
                    Create your account to start using re:Memories and start sharing your memories with your friend and/or
                    the world.
                </p>

                <form action="/register" method="post"
                    class="bg-component mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                    @csrf
                    <p class="text-white text-center text-lg font-medium">Create your account</p>

                    <div>
                        <label for="name" class="sr-only">Username</label>
                        @error('name')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="relative">
                            <input type="text" name="name"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter username" value="{{ old('name') }}" required />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4 select-none">
                                <span class="material-symbols-outlined text-gray-400">
                                    person
                                </span>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        @error('email')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                        <div class="relative">
                            <input type="email" name="email"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter email" value="{{ old('email') }}" required />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4 select-none">
                                <span class="material-symbols-outlined text-gray-400">
                                    alternate_email
                                </span>
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        @error('password')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                        <div class="relative">
                            <input type="password" name="password"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="Enter password" required />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                                <span class="material-symbols-outlined text-gray-400">
                                    password
                                </span>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label for="password_again" class="sr-only">Password</label>
                        @error('password_again')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                        <div class="relative">
                            <input type="password" name="password_again"
                                class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                                placeholder="re:Enter your passworsd" required />

                            <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
                                <span class="material-symbols-outlined text-gray-400">
                                    password
                                </span>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="block w-full rounded-lg bg-primary px-5 py-3 text-sm font-medium text-background">
                        Create account
                    </button>

                    <p class="text-center text-sm text-gray-200">
                        Already have an account?
                        <a class="underline" href="/login">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
