@extends('base')
@section('title', 'Profile')

@section('content')
    <div class="w-full flex items-center justify-center">
        <div class="w-1/2 flex flex-row items-center justify-center   ">
            <img id="profile-img" class="select-none w-64 aspect-square rounded-full z-10 bg-component p-2"
                src="https://gautier-rayeroux.fr/images/Profile_img.jpg" draggable="false" />
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
                                <button id="write_memory">Write a memory</button>
                            </div>
                            <div
                                class="flex gap-2 w-1/2 justify-center rounded-br-xl py-2 hover:text-blue-500 hover:bg-slate-600 cursor-pointer transition-all duration-200 ease-in-out ">
                                <span class="material-symbols-outlined">
                                    mode_comment
                                </span>

                                <button id="edit_profile">Edit profile</button>

                            </div>

                        </div>
                    @endif
                @endauth


            </div>

        </div>
    </div>
    @auth
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            //Prevent Context menu on profile image
            const profile_img = document.getElementById('profile-img');
            profile_img.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });



            const write_memory = document.getElementById('edit_profile');
            write_memory.addEventListener('click', function() {

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
            const cancelEdit = document.getElementById('cancelEdit');
            cancelEdit.addEventListener('click', function() {
                Swal.close();
            });
        </script>
    @endauth
@endsection
