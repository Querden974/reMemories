<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.6/dist/cdn.min.js"></script>

    {{-- LINKS --}}
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&display=swap" rel="stylesheet">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>re:Memories | @yield('title', 'Home')</title>
</head>

<body class="bg-background min-h-screen">
    <header class="flex flex-row justify-between items-baseline py-4 px-40 text-white">
        <a href="{{ route('home') }}">
            <h1 class="font-madimi text-primary text-3xl">re:Memories</h1>
        </a>

        <x-search-bar :users="$users" :info="$info" />

        @auth
            <div>
                <x-profile-user-nav />
            </div>
        @endauth


        @guest
            <div>
                <a class="text-slate-200 border-primary border-2 rounded-full px-4 py-2" href="{{ route('login') }}">Sign
                    In</a>
                <a class='text-background bg-primary rounded-full px-4 py-2' href="{{ route('register') }}">Sign Up</a>
            </div>
        @endguest

    </header>
    {{-- WIP MARKER --}}
    <marquee behavior="scroll" direction="left" scrollamount="10" class="text-red-500 text-xl font-bold"> /!\ WORK IN
        PROGRESS !
        ----------
        /!\ ----------WORK IN PROGRESS ! ---------- /!\
    </marquee>
    <marquee behavior="scroll" direction="right" scrollamount="10" class="text-red-500 text-xl font-bold"> /!\ WORK IN
        PROGRESS !
        ----------
        /!\ ----------WORK IN PROGRESS ! ---------- /!\
    </marquee>

    @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if (session($type))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        container: "mt-16",
                    }

                });
                Toast.fire({
                    icon: "{{ $type }}", // Dynamique selon le type
                    title: "{{ session($type) }}", // Message dynamique
                });
            </script>
        @endif
    @endforeach
    <div class="mt-8">

        @yield('content')
    </div>

    <footer>
        <footer class="">
            <div class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="flex justify-center text-primary">
                    <a href="/">
                        <h1 class="font-madimi text-4xl">re:Memories</h1>
                    </a>
                </div>

                <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-slate-200">
                    re:Memories is a <b class="text-primary">personal</b> project to share memories with others. It is a
                    social network where
                    you
                    can
                    share your memories with your friends and family.
                </p>

                <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-12">
                    <li>
                        <a class="text-slate-200 transition hover:text-primary/75" href="#"> About </a>
                    </li>

                    <li>
                        <a class="text-slate-200 transition hover:text-primary/75" href="#"> Careers </a>
                    </li>

                    <li>
                        <a class="text-slate-200 transition hover:text-primary/75" href="#"> FAQ </a>
                    </li>
                </ul>

                <ul class="mt-12 flex justify-center gap-6 md:gap-8">


                    <li>
                        <a href="#" rel="noreferrer" target="_blank"
                            class="text-slate-200 transition hover:text-primary/75">
                            <span class="sr-only">Dribbble</span>
                            <span class="material-symbols-outlined">
                                public
                            </span>
                        </a>
                    </li>



                    <li>
                        <a href="#" rel="noreferrer" target="_blank"
                            class="text-slate-200 transition hover:text-primary/75">
                            <span class="sr-only">GitHub</span>
                            <svg class="size-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>


                </ul>
            </div>
        </footer>
    </footer>
</body>

</html>
