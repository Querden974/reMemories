@extends('base')
@section('title', 'Profile')

@section('content')
    <div class="w-full flex items-center justify-center">
        <div class="w-1/2 flex flex-row items-center justify-center   ">
            @if (isset($profile->userInfo->profile_img))
                <img id="profile-img" class="select-none w-64 aspect-square rounded-full z-10 bg-component p-2"
                    src="{{ $profile->userInfo->imageUrl() }}" draggable="false" />
            @else
                <img id="profile-img" class="select-none w-64 aspect-square rounded-full z-10 bg-component p-2"
                    src="{{ Storage::disk('public')->url('profile_img/default_avatar.webp') }}" draggable="false" />
            @endif
            <div class="relative -translate-x-10 flex flex-col gap-5 bg-component  rounded-r-xl   ">
                <div class="flex flex-col gap-2 py-3 px-16">

                    <div class="flex gap-3">

                        <p class="text-primary font-bold text-6xl"> {{ $profile->name }}</p>
                        <p class="text-primary  text-6xl select-none">(27)</p>
                    </div>
                    @if (isset($profile->userInfo->firstname))
                        <div>
                            <div class="flex gap-2">
                                <p class="text-background text-xl select-none">{{ $profile->userInfo->firstname }}</p>
                                <p class="text-background text-xl">{{ $profile->userInfo->lastname }}</p>
                            </div>
                        </div>
                    @endif

                    @if (isset($profile->userInfo->firstname))
                        <div>
                            <div class="flex gap-2">
                                <p class="text-background text-xl select-none">Birthday:</p>
                                <p class="text-background text-xl">{{ $profile->userInfo->birthdate }}
                                </p>
                            </div>
                        </div>
                    @endif

                </div>

                @auth
                    @if (Auth::user()->id == $profile->id)
                        <div
                            class="flex flex-row gap-1 text-center justify-center items-center w-full   border-t border-background">
                            <div
                                class="flex gap-2 w-1/2 justify-center  py-2 hover:text-[#D6F13C] hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">
                                <span class="material-symbols-outlined">
                                    format_quote
                                </span>
                                <button id='write_profile'>Write a memory</button>
                            </div>
                            <div
                                class="flex gap-2 w-1/2 justify-center rounded-br-xl py-2 hover:text-orange-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>

                                <button id="edit_profile">Edit profile</button>

                            </div>

                        </div>
                    @endif
                @endauth


            </div>

        </div>
    </div>

    <div class="w-full flex flex-col items-center justify-center gap-3 mt-10">
        @foreach ($memories->where('user_id', $profile->id)->sortByDesc('created_at') as $memory)
            {{-- @dd($memory->getAttributes()) --}}

            @if ($memory->restrictions == 'private')
                @auth
                    @if (Auth::user()->id == $memory->user_id)
                        <x-card-memory :memory="$memory" :users="$users" :info="$info" />
                    @endif

                @endauth
            @elseif ($memory->restrictions == 'restricted')
                @if (Auth::user()->id == $memory->user_id)
                    <x-card-memory :memory="$memory" :users="$users" :info="$info" />
                @endif
            @else
                <x-card-memory :memory="$memory" :users="$users" :info="$info" />
            @endif
        @endforeach

    </div>
    @auth

        <script>
            //Prevent Context menu on profile image
            const profile_img = document.getElementById('profile-img');
            profile_img.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });



            const editProfile = document.getElementById('edit_profile');
            editProfile.addEventListener('click', function() {

                Swal.fire({
                    title: "Edit Profile",
                    width: 600,
                    customClass: {

                        confirmButton: "bg-primary text-background",
                        cancelButton: "bg-red-400 text-background",
                        title: "text-primary",
                        popup: "bg-component rounded-xl border border-primary",
                    },
                    html: `
                    <x-profil-edit-popup />
                      `,
                    focusConfirm: false,
                    showCancelButton: true,
                    showConfirmButton: true,

                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editProfileForm').submit();
                    }
                });
            });

            class Dropzone {
                constructor(allValidFiles) {
                    this.allValidFiles = allValidFiles;

                }

                dragOverHandler(event) {
                    event.preventDefault();
                }
                dragLeaveHandler(event) {
                    event.preventDefault();

                }

                clickHandler(event) {

                    let input = document.createElement('input');
                    input.type = 'file';
                    input.accept = 'image/jpeg, image/png, video/mp4';

                    input.multiple = true;
                    input.onchange = () => {
                        // you can use this method to get file and perform respective operations
                        let files = Array.from(input.files);
                        files.forEach(file => {
                            const filePath = URL.createObjectURL(file);
                            this.allValidFiles.push(filePath);
                            console.log(filePath);

                            const dropzone = document.getElementById('image-preview');
                            const img = document.createElement('img');
                            img.src = filePath;
                            img.className = 'w-24 h-24 rounded-md';
                            dropzone.appendChild(img);


                        });

                        console.log(this.allValidFiles);
                        //console.log(files);
                    };
                    input.click();

                }

                dropHandler(event) {

                    event.preventDefault();

                    let files = event.dataTransfer.files;
                    const validFormat = ['jpg', 'jpeg', 'png', 'mp4'];
                    const error = document.getElementById('error_upload');
                    error.innerHTML = ""; // Réinitialisez le message d'erreur pour chaque dépôt

                    for (let i = 0; i < files.length; i++) {
                        if (validFormat.includes(files[i].type.split('/')[1])) {
                            // Ajoutez le fichier valide à la liste globale
                            const filePath = URL.createObjectURL(files[i]);
                            this.allValidFiles.push(files[i]);
                            console.log(this.allValidFiles); // Affiche tous les fichiers valides ajoutés
                        } else {
                            error.innerHTML = "Invalid file format";
                        }
                    }

                    //console.log(allValidFiles); // Affiche tous les fichiers valides ajoutés
                }


                addImageInput() {
                    const dropzone = document.getElementById('image-upload');
                    this.allValidFiles.forEach(file => {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'image[]';
                        fileInput.value = file;
                        dropzone.appendChild(fileInput);
                    });
                }

                upload() {

                    const dropzone = document.getElementById('image-upload');

                    // Créer un objet FormData pour envoyer les fichiers
                    const formData = new FormData();

                    // Ajouter chaque fichier de allValidFiles à FormData
                    this.allValidFiles.forEach(file => {
                        formData.append('image[]',
                            file); // 'image[]' est la clé que Laravel utilisera pour récupérer les fichiers
                    });

                    // Ajouter le token CSRF à la requête
                    formData.append('_token', document.querySelector('input[name="_token"]').value);

                    // Envoyer la requête avec fetch
                    fetch('/upload', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Fichiers envoyés avec succès', data);
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'envoi des fichiers:', error);
                        });
                }

                showImages() {
                    const images = Array.from(event.target.files);
                    const preview = document.getElementById('image-preview');
                    preview.innerHTML = '';


                    images.forEach(image => {

                        const imagePreview = document.createElement('img');
                        imagePreview.src = URL.createObjectURL(image);
                        imagePreview.className = 'w-24 h-24 rounded-md';
                        preview.appendChild(imagePreview);
                    });

                    console.log(event.target.files);
                    // images.addEventListener('change', (event) => {

                    // });
                }
            }



            const dropzone = new Dropzone([]);




            const write_memory = document.getElementById('write_profile');
            write_memory.addEventListener('click', function() {

                Swal.fire({
                    title: "Share us your memories",
                    width: 600,
                    customClass: {

                        confirmButton: "bg-primary text-background",
                        cancelButton: "bg-red-400 text-background",
                        title: "text-primary",
                        popup: "bg-component rounded-xl border border-primary",
                    },
                    html: `
        <x-write-memory-popup />

              `,
                    focusConfirm: false,
                    showCancelButton: true,
                    showConfirmButton: true,


                }).then((result) => {

                    //dropzone.addImageInput();
                    //dropzone.upload();
                    if (result.isConfirmed) {
                        document.getElementById('writeMemoryForm').submit();
                    }
                });
            });
        </script>

    @endauth
@endsection
