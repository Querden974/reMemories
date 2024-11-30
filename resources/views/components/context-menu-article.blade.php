<div class="">
    <div class="relative ">
        <button id='context' class="inline-flex items-center overflow-hidden rounded-xl p-2 ">

            <span class="material-symbols-outlined">
                more_horiz
            </span>
        </button>
        <div class="">

            <div id='menu_context'
                class="hidden absolute transform translate-x-14 -translate-y-14  mt-2 rounded-xl border border-primary  bg-component shadow-lg"
                role="menu_context">
                <div class="p-2">
                    @foreach (['Bookmark', 'Share', 'Report'] as $item)
                        @if ($item == 'Disconnect')
                        @else
                            <a href=""
                                class="font-semibold block rounded-lg px-4 py-2 text-sm text-background hover:bg-primary hover:text-background"
                                role="menuitem">
                                {{ $item }}
                            </a>
                        @endif
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <script>
        const btn_profile = document.getElementById('context');
        const menu = document.getElementById('menu_context');
        btn_profile.addEventListener('click', function() {
            menu.classList.toggle('hidden');


        });
    </script>
</div>
