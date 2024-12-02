<div class="w-full flex items-center justify-center">
    <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl gap-3 ">
        <div id="card_header" class="flex items-center w-full justify-between p-2 border-b border-background">
            <div class="flex items-center gap-1">
                <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                    src="{{ isset($info->where('user_id', $memory->user_id)->first()->profile_img)? $info->where('user_id', $memory->user_id)->first()->imageUrl(): Storage::disk('public')->url('profile_img/default_avatar.webp') }}">
                <p class="font-semibold">{{ $users->where('id', $memory->user_id)->first()->name }}</p>
            </div>



            <div class="flex items-center gap-16">
                <p class="text-primary"> {{ $memory->created_at->diffForHumans() }}</p>
                {{-- <x-context-menu-article :memory="$memory" /> --}}
            </div>

        </div>
        <div>

            <div id="content">
                <p class="px-2">{{ $memory->content }}</p>
            </div>
        </div>
        <div class="flex flex-row gap-1 text-center justify-center items-center w-full   border-t border-background">
            <div
                class="flex gap-2 w-1/2 justify-center rounded-bl-xl py-2 hover:text-red-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">
                <span class="material-symbols-outlined">
                    favorite
                </span>
                <p class=" ">Like</p>
                @if (isset($memory->liked_by))
                    <p class="text-red-500">{{ $memory->liked_by->count() }}</p>
                @endif
            </div>
            <div
                class="flex gap-2 w-1/2 justify-center rounded-br-xl py-2 hover:text-blue-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">
                <span class="material-symbols-outlined">
                    mode_comment
                </span>
                <p class=" ">Comments</p>
                @if (isset($memory->comments))
                    <p class="text-red-500">{{ $memory->comments->count() }}</p>
                @endif

            </div>

        </div>
    </div>
</div>
