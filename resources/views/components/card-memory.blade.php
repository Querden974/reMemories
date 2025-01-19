<div class="w-full flex items-center justify-center">
    <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl gap-3 ">
        <div id="card_header" class="flex items-center w-full justify-between p-2 border-b border-background">
            <a href="{{ route('profileShow', ['user' => $users->where('id', $memory->user_id)->first()->name]) }}">
                <div class="flex items-center gap-1">
                    <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                        src="{{ isset($info->where('user_id', $memory->user_id)->first()->profile_img)? $info->where('user_id', $memory->user_id)->first()->imageUrl(): Storage::disk('public')->url('profile_img/default_avatar.webp') }}">
                    <p class="font-semibold">{{ $users->where('id', $memory->user_id)->first()->name }}</p>
                </div>
            </a>




            <div class="flex items-center gap-16">
                <p class="text-primary"> {{ $memory->created_at->diffForHumans() }}</p>

                {{-- TO DEBUG --}}
                <x-context-menu-article :memory="$memory" />

            </div>

        </div>
        <div class="w-full px-3">

            <div id="content" class="flex flex-col justify-start w-full gap-2">
                <p class="text-xl underline">{{ $memory->title }}</p>
                <p class="">{!! nl2br(e($memory->content)) !!}</p>

                <div class="flex flex-row gap-4 justify-center items-center">
                    @if ($memory->images != null && is_array(json_decode($memory->images, true)))
                        @foreach (json_decode($memory->images, true) as $image)
                            <button onclick="openPicture('{{ Storage::disk('public')->url($image) }}')">
                                <img class="max-w-32 aspect-square rounded-xl cursor-pointer " draggable="false"
                                    src="{{ Storage::disk('public')->url($image) }}" />
                            </button>
                        @endforeach

                    @endif
                </div>


            </div>

        </div>
        <div class="flex w-full justify-center items-center border-t border-background">
            <form action="" method="POST"
                class="flex flex-row gap-1 text-center justify-center items-center w-1/2 m-0 ">
                @method('PUT')
                @csrf


                {{-- LIKE BUTTON --}}
                <button name="like" id="like_{{ $memory->id }}" value="{{ $memory->id }}"
                    class="flex gap-2 w-full justify-center rounded-bl-xl py-2 hover:text-red-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">

                    {{-- CHECK IF USER LIKED --}}
                    @auth
                        @if (is_array(json_decode($memory->liked_by, true)) && in_array(Auth::user()->id, json_decode($memory->liked_by, true)))
                            <span class="material-symbols-outlined text-red-500">
                                heart_check
                            </span>
                        @else
                            <span class="material-symbols-outlined">
                                favorite
                            </span>
                        @endif
                    @endauth

                    <p class=" ">Like</p>
                    @if (isset($memory->liked_by) && count(json_decode($memory->liked_by, true)) > 0)
                        <p class="">{{ count(json_decode($memory->liked_by, true)) }}</p>
                    @endif
                </button>
            </form>
            {{-- COMMENTS BUTTON --}}
            <button id="btn_comment_{{ $memory->id }}"
                class="btn-comment flex gap-2 w-1/2 justify-center rounded-br-xl py-2 hover:text-blue-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out"
                data-id="{{ $memory->id }}">
                <span class="material-symbols-outlined">mode_comment</span>
                <p>Comments</p>
                @if (isset($memory->comments) && count(json_decode($memory->comments, true)) > 0)
                    <p class="">{{ count(json_decode($memory->comments, true)) }}</p>
                @endif
            </button>
        </div>
    </div>
</div>

<script>
    function openPicture(url) {
        console.log(url);
        Swal.fire({
            imageUrl: url,
            showConfirmButton: false,
            background: "rgba(0, 0, 0, 0.0)",
            imageAlt: "Custom image"
        });
    }
</script>
