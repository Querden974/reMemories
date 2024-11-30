<div class="w-full flex items-center justify-center">
    <div class="w-1/3 flex flex-col items-center justify-center bg-component rounded-xl">
        <div id="entry-form" class="flex  gap-4 px-4 pt-4 pb-2 w-full rounded-lg ">


            <img class="w-9 aspect-square rounded-full  border-primary " draggable="false"
                src="https://gautier-rayeroux.fr/images/Profile_img.jpg" />

            <button type="button" id="write_memory"
                class="bg-primary w-full px-4 rounded-full text-start placeholder:text-black placeholder:text-sm hover:bg-primary-hover">What
                are you
                thinking about?</button>

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
            console.log(this.allValidFiles);
            let input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/jpeg, image/png, video/mp4';
            input.multiple = true;
            input.onchange = () => {
                // you can use this method to get file and perform respective operations
                let files = Array.from(input.files);
                this.allValidFiles.push(...files);
                console.log(this.allValidFiles);
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
                    this.allValidFiles.push(files[i]);
                    console.log(this.allValidFiles); // Affiche tous les fichiers valides ajoutés
                } else {
                    error.innerHTML = "Invalid file format";
                }
            }

            //console.log(allValidFiles); // Affiche tous les fichiers valides ajoutés
        }
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
            if (result.isConfirmed) {
                document.getElementById('editProfileForm').submit();
            }
        });
    });
    const cancelEdit = document.getElementById('cancelEdit');
    cancelEdit.addEventListener('click', function() {
        Swal.close();
    });


    //IMAGE UPLOAD FUNCTIONS
</script>
