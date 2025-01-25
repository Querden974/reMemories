<div class="w-1/4" x-data="autocomplete()">
    <form action="/search" id="search_form" method="post">
        @csrf
        <div class="relative">
            <input type="text" name="search_bar" id="search_bar" placeholder="Search your friend" autocomplete="off"
                class="rounded-full p-2 w-full border-[3px] border-primary hover:border-primary-hover bg-component placeholder:text-primary cursor-pointer"
                x-model="searchTerm" @input="filterItems">

            <button
                class="select-none absolute inset-y-0 end-0 grid place-content-center rounded-full hover:bg-primary border-[3px] border-primary">
                <span class="material-symbols-outlined text-gray-400 p-3">
                    search
                </span>
            </button>
        </div>
    </form>

    <div id="autocomplete" class="w-1/5 absolute mt-2 z-50 bg-background rounded-xl p-2 shadow-lg border border-primary"
        x-show="filteredItems.length > 0" x-transition>
        <ul>
            <template x-for="item in filteredItems" :key="item.name">
                <a :href="`/profile/${item.name}`">
                    <li
                        class="p-2 hover:bg-primary rounded-xl hover:text-background cursor-pointer flex gap-2 items-center">
                        <img class="w-8 aspect-square rounded-full" :src="item.profile_img" />
                        <p x-text="item.name"></p>
                    </li>
                </a>
            </template>
        </ul>
    </div>
</div>

<script>
    // Liste des utilisateurs récupérée côté serveur
    const userList = @json($users);
    const userInfo = @json($info);
    const baseAvatarUrl = `{{ Storage::disk('public')->url('/app/public/') }}`;

    // Créer la liste des utilisateurs avec l'URL de leur avatar
    const list = [];
    userList.forEach(user => {
        userInfo.forEach(info => {
            if (user.id === info.user_id) {
                const AvatarUrl = `${baseAvatarUrl}${info.profile_img}`;
                list.push({
                    name: user.name,
                    profile_img: AvatarUrl
                });
            } else {
                const AvatarUrl = `${baseAvatarUrl}/profile_img/default_avatar.webp`;
                list.push({
                    name: user.name,
                    profile_img: AvatarUrl
                });
            }
        });
    });

    // Fonction AlpineJS pour gérer l'autocomplétion
    function autocomplete() {
        return {
            searchTerm: '',
            items: list,
            filteredItems: [],

            // Filtrer les items en fonction de l'entrée de l'utilisateur
            filterItems() {
                // Ne commencer à filtrer que si la longueur du terme de recherche est supérieure à 2 caractères
                if (this.searchTerm.length >= 2) {
                    this.filteredItems = this.items.filter(item => {
                        return item.name.toLowerCase().includes(this.searchTerm.toLowerCase());
                    });
                } else {
                    // Si moins de 3 caractères, on vide la liste des résultats
                    this.filteredItems = [];
                }
            }
        };
    }
</script>
