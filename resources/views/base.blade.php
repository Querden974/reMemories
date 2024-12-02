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
        <a href="/">
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
                <a class="text-slate-200 border-primary border-2 rounded-full px-4 py-2" href="/login">Sign In</a>
                <a class='text-background bg-primary rounded-full px-4 py-2' href="/register">Sign Up</a>
            </div>
        @endguest

    </header>

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
</body>

</html>
