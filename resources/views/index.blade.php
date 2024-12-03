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

        @foreach ($memories->sortByDesc('created_at') as $memory)
            {{-- @dd($memory->getAttributes()) --}}

            @if ($memory->restrictions == 'private')
                @auth
                    @if (Auth::user()->id == $memory->user_id)
                        <x-card-memory :memory="$memory" :users="$users" :info="$info" />
                    @endif
                @endauth
            @elseif ($memory->restrictions == 'restricted')
                @if (Auth::user()->id == $memory->user_id)
                    <x-card-memory :memory="$memory" :users="$users" :info="$info" />
                @endif
            @else
                <x-card-memory :memory="$memory" :users="$users" :info="$info" />
            @endif
        @endforeach

    </main>
    <script>
        // Sélectionner tous les boutons de commentaire
        const commentButtons = document.querySelectorAll('.btn-comment');

        commentButtons.forEach(button => {
            button.addEventListener('click', () => {
                const memoryId = button.getAttribute('data-id'); // Récupère l'ID du bouton
                console.log(`ID de $memory : ${memoryId}`);

                // Utilise fetch pour charger dynamiquement le contenu via une route
                fetch(`/memories/${memoryId}/comments`)
                    .then(response => response.text()) // Récupère le contenu HTML
                    .then(html => {
                        // Affiche le contenu dans le popup SweetAlert2
                        Swal.fire({
                            title: "Comments",
                            width: 600,
                            customClass: {
                                confirmButton: "bg-primary text-background",
                                cancelButton: "bg-red-400 text-background",
                                title: "text-primary",
                                popup: "bg-component rounded-xl border border-primary",
                            },
                            focusConfirm: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            html: html, // Injecte le contenu récupéré par fetch
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('writeComment').submit();
                            }
                        });
                    })
                    .catch(error => console.error('Error loading comment popup:', error));
            });
        });
    </script>
@endsection
