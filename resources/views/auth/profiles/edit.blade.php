<x-layout>

    <x-navigation />

    
    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 flex flex-col justify-center items-center lg:w-full">
            <h2 class="font-semibold text-2xl">Edit your profile</h2>
            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data" class="mt-8" autocomplete="off">
                @csrf
                <p class="text-xs bg-yellow-400 font-semibold text-center p-1 rounded mb-1 text-yellow-800"> <i class="fa-solid fa-circle-info"></i> You can change your username once a month</p>
                <x-form.input name='username' labelText='Username' type='text' placeholder='Username...' value='{{ Auth::user()->username }}' />
                <x-form.input name='avatar' labelText='Profile Picture' type='file' placeholder='Profile Picture...'/>
                <x-form.input name='old_password' labelText='Old Password' type='password' placeholder='Old Password...' autocomplete="off"/>
                <x-form.input name='password' labelText='New Password' type='password' placeholder='New Password...' autocomplete="off"/>
                <x-form.submit buttonText='Update'/>
            </form>
        </div>
    </div>

</x-layout>
