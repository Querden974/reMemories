<div class="overflow-hidde">
    <div class="relative ">
        <button id='btn_profile'
            class="inline-flex items-center overflow-hidden rounded-xl border border-primary bg-background">

            <p
                class="font-bold flex items-center gap-2 px-4 py-2 text-sm/none text-primary hover:bg-primary hover:text-background">
                <img class="w-7 aspect-square rounded-full" src="https://gautier-rayeroux.fr/images/Profile_img.jpg"
                    alt="">{{ auth()->user()->name }}
            </p>
        </button>
        <div class="overflow-hidden">

            <div id='menu'
                class="hidden absolute end-1  mt-2 rounded-xl border border-primary  bg-component shadow-lg"
                role="menu">
                <div class="p-2">
                    @foreach (['Profile', 'Settings', 'Disconnect'] as $item)
                        @if ($item == 'Disconnect')
                            <a href="/logout"
                                class="font-semibold block rounded-lg px-4 py-2 text-sm text-red-500 hover:bg-red-500 hover:text-background"
                                role="menuitem">
                                {{ $item }}
                            </a>
                        @else
                            <a href="{{ strtolower($item) }}"
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
        const btn_profile = document.getElementById('btn_profile');
        const menu = document.getElementById('menu');
        btn_profile.addEventListener('click', function() {
            menu.classList.toggle('hidden');


        });
    </script>
</div>
