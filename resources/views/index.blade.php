@extends('base')
@section('content')
    <main class="flex flex-col gap-5 mt-10 ">

        @auth
            <x-memory-field />
        @endauth

        @guest
            <div class="w-full flex items-center justify-center">
                <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl">
                    <a href="/login">
                        <h2 class="p-2 text-primary font-semibold">You need to be connected to share your memories</h2>
                    </a>
                </div>
            </div>
        @endguest

        <x-card-memory />
        <x-card-memory-article />
    </main>
@endsection
