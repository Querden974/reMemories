<div>
    <div class="flex flex-col border border-black border-dashed rounded-lg p-4 mt-3 gap-3">
        <h1 class="text-background font-bold text-xl">{{ $memory->title }}</h1>
        <p class="text-start text-black">{!! nl2br(e($memory->content)) !!}</p>
    </div>

    <form action="/comment/submit" method="post" id='writeComment' enctype="multipart/form-data" class="">
        @csrf
        <input type="hidden" name="memory_id" value="{{ $memory->id }}">
        <div class='flex flex-col mt-3 '>
            <div>
                <label for="name" class="sr-only">Pseudo</label>

                <div class="relative">
                    <textarea type="text" name="comment" id="comment" rows="1"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Write a comment on {{ $users->where('id', $memory->user_id)->first()->name }}'s memory"
                        value="{{ old('name') }}" required></textarea>

                    <button type="submit" class="select-none absolute inset-y-0 end-0 grid place-content-center  ">
                        <span class="material-symbols-outlined text-primary py-1 border-l border-black px-3 ">
                            send
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>
    @if (isset($memory->liked_by) && count(json_decode($memory->liked_by, true)) > 0)
        <div class="mt-3">
            <p class="text-start text-red-500 font-bold">Liked by:</p>
            <div class="flex flex-row gap-3">
                @foreach (json_decode($memory->liked_by, true) as $like)
                    <p class="text-black">{{ $users->where('id', $like)->first()->name }}</p>
                @endforeach
            </div>

        </div>
        <div class="border-b-2 border-background my-6"></div>
    @endif
    <div class="flex flex-col mt-4 gap-2" id="comments_area">
        @if (isset($memory->comments) && count(json_decode($memory->comments, true)) > 0)

            @foreach (json_decode($memory->comments, true) as $comment)
                <div class="flex flex-row items-center gap-4">
                    <a href="/profile/{{ $users->where('id', $comment['author'])->first()->name }}">
                        <div class="flex items-center gap-1">
                            <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                                src="{{ isset($info->where('user_id', $comment['author'])->first()->profile_img)? $info->where('user_id', $comment['author'])->first()->imageUrl(): Storage::disk('public')->url('profile_img/default_avatar.webp') }}">
                            <p class="font-semibold text-background underline">
                                {{ $users->where('id', $comment['author'])->first()->name }} : </p>
                        </div>
                    </a>

                    <p class="text-background">{{ $comment['comment'] }}</p>
                </div>
            @endforeach
        @endif

    </div>
</div>
