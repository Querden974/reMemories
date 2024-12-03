<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contextBtn = document.querySelectorAll('.context-btn');
        const contextMenu = document.querySelectorAll('.menu');

        console.log(contextMenu);
        contextBtn.forEach(btn => {
            console.log(btn);
            btn.addEventListener('click', function() {

                const menu = document.getElementById(`ctxt_menu_${btn.value}`);
                menu.classList.toggle('hidden');
            });
        });

    });
</script>
