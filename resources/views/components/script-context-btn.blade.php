<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contextBtns = document.querySelectorAll('.context-btn');
        const contextMenus = document.querySelectorAll('.menu');

        let openMenuId = null; // Variable pour stocker l'ID du menu actuellement ouvert

        contextBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const menuId = `ctxt_menu_${btn.value}`;
                const menu = document.getElementById(menuId);

                // Fermer tous les autres menus avant d'ouvrir le nouveau
                contextMenus.forEach(otherMenu => {
                    if (otherMenu.id !== menuId) {
                        otherMenu.classList.add('hidden');
                    }
                });

                // Basculer l'état du menu actuel
                if (menu) {
                    const isHidden = menu.classList.contains('hidden');
                    if (isHidden) {
                        menu.classList.remove('hidden');
                        openMenuId = menuId; // Mémorise l'ID du menu ouvert
                    } else {
                        menu.classList.add('hidden');
                        openMenuId = null; // Aucun menu ouvert
                    }
                }

            });
        });


        document.addEventListener('click', function(event) {
            if (!event.target.closest('.context-btn') && !event.target.closest('.menu')) {
                contextMenus.forEach(menu => menu.classList.add('hidden'));
                openMenuId = null; // Réinitialise la variable

            }
        });
    });
</script>
