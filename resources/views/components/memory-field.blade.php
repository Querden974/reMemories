<div class="w-full flex items-center justify-center">
    <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl">
        <div id="entry-form" class="flex  gap-4 px-4  py-3 w-full rounded-lg ">



            @auth
                @if (isset(auth()->user()->userInfo->profile_img))
                    <img class="w-9 aspect-square rounded-full border-[3px] border-primary " draggable="false"
                        src="{{ auth()->user()->userInfo->imageUrl() }}" />
                @else
                    <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                        src="{{ Storage::disk('public')->url('profile_img/default_avatar.webp') }}" />
                @endif

            @endauth
            @guest
                <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                    src="https://gautier-rayeroux.fr/images/Profile_img.jpg" />
            @endguest

            <button type="button" id="write_memory"
                class="bg-primary w-full px-4 rounded-full text-start placeholder:text-black placeholder:text-sm hover:bg-primary-hover">What
                are you
                thinking about?</button>

        </div>
        {{-- <div class="p-2">
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
        </div> --}}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
                    //console.log(this.allValidFiles); // Affiche tous les fichiers valides ajoutés
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
            const formData = new FormData();

            // Ajouter chaque fichier sélectionné (réel) à FormData
            this.allValidFiles.forEach(file => {
                formData.append('images[]', file); // Laravel attend 'images[]'
            });

            // Ajouter le token CSRF
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            console.log('Données envoyées:', formData);

            // Envoyer la requête avec fetch (NE PAS AJOUTER Content-Type MANUELLEMENT)
            fetch('/upload', {
                    method: 'POST',
                    body: formData, // fetch() gère 'multipart/form-data' automatiquement

                })
                .then(response => response.json())
                .then(data => {
                    console.log('Fichiers envoyés avec succès:', data);
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

    function sendForm(form) {
        const formData = new FormData(form);
        const csrfToken = document.querySelector('input[name="_token"]').value;

        fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json()) // Lire la réponse en texte
            .then(data => {
                console.log('Formulaire envoyé avec succès:', data);
            })
            .catch(error => {
                console.error('Erreur lors de l\'envoi du formulaire:', error);
            });
    }




    const dropzone = new Dropzone([]);




    const write_memory = document.getElementById('write_memory');
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
                //console.log(document.getElementById('writeMemoryForm'));
                //sendForm(document.getElementById('writeMemoryForm'));
                //dropzone.upload();
                document.getElementById('writeMemoryForm').submit();
            }
        });
    });
</script>
