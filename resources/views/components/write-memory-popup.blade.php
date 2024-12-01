<form action="/upload" method="post" id='writeMemoryForm' enctype="multipart/form-data">
    @csrf
    <div class='flex flex-col'>
        <div class="flex flex-col items-baseline mr-2 w-full">
            <label for="title" class="block font-medium text-background w-max">Title</label>
            <input id="title" name="title" type="text" placeholder="Enter a title"
                class="h-[60px] rounded-lg border border-gray-200 p-4 pe-12 text-sm shadow-sm w-full">
        </div>

    </div>
    <div class='flex flex-col'>
        <div class="flex flex-col items-baseline mt-4 w-full">
            {{-- <label for="birthdate" class="block font-medium text-background">Birthdate</label> --}}
            <textarea rows="8" name="content" type="text" id="content" placeholder="Enter your memory"
                class=" rounded-lg border border-gray-200 p-4  text-sm shadow-sm w-full"></textarea>\
        </div>
    </div>

    <div class='flex flex-col'>
        <div id="image-upload" dropzone="copy"
            class="flex flex-col items-center justify-center mt-4 h-32 w-full rounded-lg border-2 border-dashed border-gray-300 cursor-pointer"
            onclick='dropzone.clickHandler(event)' ondrop="dropzone.dropHandler(event)"
            ondragover="dropzone.dragOverHandler(event)" ondragleave="dropzone.dragLeaveHandler(event)">

            <p class="text-primary">Drag and drop your image here</p>.
            <p>Valid formats: JPG, PNG, MP4</p>
            <div id="error_upload" class="text-red-500 text-sm font-bold">
            </div>


        </div>
    </div>
    <div class="flex flex-row mt-4 gap-2" id="image-preview">

    </div>

</form>
