<div class="card">
    <div class="relative">
        <button class="context-btn inline-flex items-center overflow-hidden rounded-xl p-2" value="{{ $memory->id }}">
            <span class="material-symbols-outlined">more_horiz</span>
        </button>
        <div class="">
            <div class="menu hidden absolute transform translate-x-14 -translate-y-14 mt-2 rounded-xl border border-primary bg-component shadow-lg"
                value="{{ $memory->id }}" role="menu_context" id="ctxt_menu_{{ $memory->id }}">
                <div class="p-2">
                    @foreach (['Bookmark', 'Share', 'Report', 'Delete'] as $item)
                        @if ($item == 'Share')
                            @if ($memory->restrictions != 'private')
                                <a href=""
                                    class="font-semibold block rounded-lg px-4 py-2 text-sm w-full text-left text-background hover:bg-primary hover:text-background"
                                    role="menuitem">
                                    {{ $item }}
                                </a>
                            @endif
                        @elseif ($item == 'Delete')
                            @if (Auth::user()->id == $memory->user_id)
                                <a href="{{ route('removePost', ['id' => $memory->id]) }}"
                                    class="font-semibold block rounded-lg px-4 py-2 text-sm w-full text-left text-background hover:bg-red-500 hover:text-slate-50"
                                    role="menuitem">
                                    {{ $item }}
                                </a>
                            @endif
                        @else
                            <button href=""
                                class="font-semibold block rounded-lg px-4 py-2 text-sm w-full text-left text-background hover:bg-primary hover:text-background"
                                role="menuitem">
                                {{ $item }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
