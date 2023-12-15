<x-layout>

    <div class="flex">
        <img src="https://images.pexels.com/photos/4526473/pexels-photo-4526473.jpeg?cs=srgb&dl=pexels-screen-post-4526473.jpg&fm=jpg&w=1920&h=2880" class="w-1/2 h-screen object-cover" alt="">
        <div class="flex flex-col w-1/2 h-screen justify-center items-center">
            <h1 class="text-4xl font-bold mb-6">Sign In</h1>
            <form action="#" method="post">
                <x-form.input type='text' name='username' labelText='Username' placeholder='@username' />
                <x-form.input type='password' name='password' labelText='Password' placeholder='Password' />
                <input type="submit" value="SIGN IN" class="w-full h-10 mt-2 rounded-md text-white font-bold text-xl bg-purple-500">
            </form>
            <p class="text-sm mt-2">You don't have an account? <a href="/sign-up" class="text-purple-600 font-semibold">Sign Up</a> </p>
        </div>
    </div>

    <div class="design relative">
        <div class="box w-60 h-52 bg-purple-500 absolute right-0 bottom-0 rounded-tl-3xl shadow-2xl"></div>
        <div class="box w-40 h-28 bg-purple-700 absolute right-60 bottom-0 rounded-tl-3xl shadow-2xl"></div>
        <div class="box w-40 h-28 bg-purple-700 absolute right-0 bottom-52  rounded-tl-3xl shadow-2xl"></div>
        <div class="box w-14 h-14 bg-purple-800 absolute right-60 bottom-28 rounded-tl-3xl shadow-2xl"></div>
        <div class="box w-14 h-14 bg-purple-800 absolute right-40 bottom-52  rounded-tl-3xl shadow-2xl"></div>
    </div>

</x-layout>