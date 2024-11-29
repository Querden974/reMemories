<div class="w-full flex items-center justify-center">
    <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl">
        <div id="entry-form" class="flex  gap-4 px-4 pt-4 pb-2 w-full rounded-lg ">
            @guest
                <span class="material-symbols-outlined select-none bg-slate-400 p-2 rounded-full">
                    face
                </span>
            @endguest

            @auth
                <img class="w-9 aspect-square rounded-full" src="https://gautier-rayeroux.fr/images/Profile_img.jpg" />
            @endauth
            <input type="text" placeholder="What are you thinking about?"
                class="bg-primary w-full px-4 rounded-full placeholder:text-black placeholder:text-sm">

        </div>
        <div class="p-2">
            <div class="flex flex-row gap-4 px-4 pb-2">
                <div class="flex gap-2">
                    <span class="material-symbols-outlined select-none text-primary">
                        add_a_photo
                    </span>
                    <p class=" text-white">Photo / Video</p>
                </div>
                <div class="flex gap-2">
                    <span class="material-symbols-outlined text-[#D6F13C]">
                        format_quote
                    </span>
                    <p class=" text-white">Quote</p>
                </div>

            </div>
        </div>
    </div>
</div>
