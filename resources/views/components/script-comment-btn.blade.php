<script>
    // Sélectionner tous les boutons de commentaire
    const commentButtons = document.querySelectorAll('.btn-comment');


    commentButtons.forEach(button => {
        button.addEventListener('click', () => {
            const memoryId = button.getAttribute('data-id'); // Récupère l'ID du bouton
            const routeTemplate = "{{ route('comment', ['id' => '__ID__']) }}";
            const route = routeTemplate.replace("__ID__", memoryId);
            console.log(`ID de $memory : ${memoryId}`);

            // Utilise fetch pour charger dynamiquement le contenu via une route
            fetch(route)
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
