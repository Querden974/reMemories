@auth


    <div class="">
        <div class="relative ">
            <button id='btn_profile'
                class="inline-flex items-center overflow-hidden rounded-xl border border-primary bg-background">

                <p
                    class="font-bold flex items-center gap-2 px-4 py-2 text-sm/none text-primary hover:bg-primary hover:text-background">
                    {{ auth()->user()->name }}
                    @if (isset(auth()->user()->userInfo->profile_img))
                        <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                            src="{{ auth()->user()->userInfo->imageUrl() }}" />
                    @else
                        <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                            src="{{ Storage::disk('public')->url('profile_img/default_avatar.webp') }}" />
                    @endif
                </p>
            </button>
            <div class="overflow-hidden">

                <div id='menu'
                    class="hidden absolute end-1  mt-2 rounded-xl border border-primary  bg-component shadow-lg  z-50"
                    role="menu">
                    <div class="p-2">
                        <a href="{{ route('profileShow', ['user' => auth()->user()->name]) }}"
                            class="font-semibold block rounded-lg px-4 py-2 text-sm text-background hover:bg-primary hover:text-background"
                            role="menuitem">
                            Profile
                        </a>
                        <a href=""
                            class="font-semibold block rounded-lg px-4 py-2 text-sm text-background hover:bg-primary hover:text-background"
                            role="menuitem">
                            Settings
                        </a>

                        <a href="/logout"
                            class="font-semibold block rounded-lg px-4 py-2 text-sm text-red-500 hover:bg-red-500 hover:text-background"
                            role="menuitem">
                            Disconnect
                        </a>



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

            document.addEventListener('click', function(event) {
                if (!event.target.closest('#btn_profile') && !event.target.closest('#menu')) {
                    menu.classList.add('hidden');

                }

            });
        </script>
    </div>
@endauth
