<form action="" method="post" id='editProfileForm'>
    @csrf
    <div class="flex flex-col items-baseline mr-2 w-fit">
        <label for="firstname" class="block font-medium text-background w-max">Pseudo</label>
        <input id="firstname" name="pseudo" type="text" palceholder="Pseudo" value="{{ auth()->user()->name }}"
            class="h-[60px] rounded-lg border border-gray-200 p-4 pe-12 text-sm shadow-sm w-64 ">
    </div>
    <div class=flex flex-col>
        <div class="flex flex-col items-baseline mr-2 w-fit">
            <label for="firstname" class="block font-medium text-background w-max">Firstname</label>
            <input id="firstname" name="firstname" type="text" palceholder="Firstname"
                class="h-[60px] rounded-lg border border-gray-200 p-4 pe-12 text-sm shadow-sm w-64">
        </div>
        <div class="flex flex-col items-baseline ml-2 w-fit">
            <label for="lastname" class="block font-medium text-background">Lastname</label>
            <input id="lastname" name="lastname" type="text" palceholder="Lastname"
                class="h-[60px] rounded-lg border border-gray-200 p-4  text-sm shadow-sm w-64">
        </div>
    </div>
    <div class=flex flex-col>
        <div class="flex flex-col items-baseline mt-4 w-full">
            <label for="birthdate" class="block font-medium text-background">Birthdate</label>
            <input id="birthdate" name="birthdate" type="date"
                class="h-[60px] rounded-lg border border-gray-200 p-4  text-sm shadow-sm w-64">
        </div>
        <div class="flex flex-col items-baseline mt-4 w-full">
            <label for="profileImg" class="block font-medium text-background">Profile picture</label>
            <input id="profileImg" name="profileImg" type="file" accept='.jpg, .jpeg, .png' title=" "
                class="rounded-lg border border-gray-200 bg-white p-4 text-sm shadow-sm w-64 text-component">
        </div>
    </div>


</form>
