<x-layout>

    <div class="flex">
        <div class="flex flex-col w-1/2 h-screen justify-center items-center">
            <h1 class="text-4xl font-bold mb-6">Sign Up</h1>
            <form action="#" method="post">
                <x-form.input type='text' name='username' labelText='Username' placeholder='@username' />
                <x-form.input type='email' name='email' labelText='Email' placeholder='example@mail.com' />
                <x-form.input type='password' name='password' labelText='Password' placeholder='Password' />
                <x-form.input type='password' name='password_confirm' labelText='Password Confirm'
                    placeholder='Password Confirm' />
                <input type="submit" value="SIGN UP"
                    class="w-full h-10 mt-2 rounded-md text-white font-bold text-xl bg-purple-500">
            </form>
            <p class="text-sm mt-2">Do you already have an account? <a href="/sign-in"
                    class="text-purple-600 font-semibold">Sign In</a> </p>
        </div>
        <img src="https://images.pexels.com/photos/4526473/pexels-photo-4526473.jpeg?cs=srgb&dl=pexels-screen-post-4526473.jpg&fm=jpg&w=1920&h=2880"
            class="w-1/2 h-screen object-cover" alt="">
    </div>

    <div class="design relative">
        <div class="box w-60 h-52 bg-purple-500 absolute left-0 bottom-0 rounded-tr-3xl shadow-2xl"></div>
        <div class="box w-40 h-28 bg-purple-700 absolute left-60 bottom-0 rounded-tr-3xl shadow-2xl"></div>
        <div class="box w-40 h-28 bg-purple-700 absolute left-0 bottom-52  rounded-tr-3xl shadow-2xl"></div>
        <div class="box w-14 h-14 bg-purple-800 absolute left-60 bottom-28 rounded-tr-3xl shadow-2xl"></div>
        <div class="box w-14 h-14 bg-purple-800 absolute left-40 bottom-52  rounded-tr-3xl shadow-2xl"></div>
    </div>
</x-layout>
