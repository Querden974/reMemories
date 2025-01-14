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
        let input = document.createElement("input");
        input.type = "file";
        input.accept = "image/jpeg, image/png, video/mp4";

        input.multiple = true;
        input.onchange = () => {
            // you can use this method to get file and perform respective operations
            let files = Array.from(input.files);
            files.forEach((file) => {
                const filePath = URL.createObjectURL(file);
                this.allValidFiles.push(filePath);
                console.log(filePath);

                const dropzone = document.getElementById("image-preview");
                const img = document.createElement("img");
                img.src = filePath;
                img.className = "w-24 h-24 rounded-md";
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
        const validFormat = ["jpg", "jpeg", "png", "mp4"];
        const error = document.getElementById("error_upload");
        error.innerHTML = ""; // Réinitialisez le message d'erreur pour chaque dépôt

        for (let i = 0; i < files.length; i++) {
            if (validFormat.includes(files[i].type.split("/")[1])) {
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
        const dropzone = document.getElementById("image-upload");
        this.allValidFiles.forEach((file) => {
            const fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "image[]";
            fileInput.value = file;
            dropzone.appendChild(fileInput);
        });
    }

    upload() {
        const dropzone = document.getElementById("image-upload");

        // Créer un objet FormData pour envoyer les fichiers
        const formData = new FormData();

        // Ajouter chaque fichier de allValidFiles à FormData
        this.allValidFiles.forEach((file) => {
            formData.append("image[]", file); // 'image[]' est la clé que Laravel utilisera pour récupérer les fichiers
        });

        // Ajouter le token CSRF à la requête
        formData.append(
            "_token",
            document.querySelector('input[name="_token"]').value
        );

        // Envoyer la requête avec fetch
        fetch("/upload", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                console.log("Fichiers envoyés avec succès", data);
            })
            .catch((error) => {
                console.error("Erreur lors de l'envoi des fichiers:", error);
            });
    }

    showImages() {
        const images = Array.from(event.target.files);
        const preview = document.getElementById("image-preview");
        preview.innerHTML = "";

        images.forEach((image) => {
            const imagePreview = document.createElement("img");
            imagePreview.src = URL.createObjectURL(image);
            imagePreview.className = "w-24 h-24 rounded-md";
            preview.appendChild(imagePreview);
        });

        console.log(event.target.files);
        // images.addEventListener('change', (event) => {

        // });
    }
}

const dropzone = new Dropzone([]);

const write_memory = document.getElementById("write_memory");
write_memory.addEventListener("click", function () {
    const page = `<x-write-memory-popup />`;

    Swal.fire({
        title: "Share us your memories",
        width: 600,
        customClass: {
            confirmButton: "bg-primary text-background",
            cancelButton: "bg-red-400 text-background",
            title: "text-primary",
            popup: "bg-component rounded-xl border border-primary",
        },
        html: page,
        focusConfirm: false,
        showCancelButton: true,
        showConfirmButton: true,
    }).then((result) => {
        //dropzone.addImageInput();
        //dropzone.upload();
        if (result.isConfirmed) {
            document.getElementById("writeMemoryForm").submit();
        }
    });
});
