<x-layout>
    <style>
        body{
            overflow: hidden;
        }
    </style>
    <div class="flex">
        <img src="https://images.pexels.com/photos/4526473/pexels-photo-4526473.jpeg?cs=srgb&dl=pexels-screen-post-4526473.jpg&fm=jpg&w=1920&h=2880" class="w-1/2 h-screen object-cover" alt="">
        <div class="flex flex-col w-1/2 h-screen justify-center items-center relative">
            <h1 class="text-4xl font-bold mb-6">Sign In</h1>
            <form action="/sign-in" method="post">
                @csrf
                <x-form.input type='text' name='username' labelText='Username' placeholder='username' />
                <x-form.input type='password' name='password' labelText='Password' placeholder='Password' />
                <x-form.submit buttonText='SIGN IN'/>
            </form>
            <p class="text-sm mt-2">You don't have an account? <a href="/sign-up" class="text-purple-600 font-semibold">Sign Up</a> </p>
            <div class="design">
                <div class="box w-full h-full bg-purple-200 absolute left-0 top-0 -z-30"></div>
                <div class="box w-72 h-40 bg-purple-500 absolute top-0 right-0 rounded-bl-3xl"></div>
                <div class="box w-40 h-40 bg-purple-600 absolute top-40 right-0 rounded-bl-3xl -upDown -z-10"></div>
                <div class="box w-40 h-24 bg-purple-600 absolute top-0 right-72 rounded-bl-3xl -leftRight -z-10"></div>
                <div class="box w-14 h-24 bg-purple-700 absolute top-40 right-40 rounded-bl-3xl -upDown -z-20"></div>

                <div class="box w-72 h-40 bg-purple-500 absolute top-0 left-0 rounded-br-3xl"></div>
                <div class="box w-40 h-40 bg-purple-600 absolute top-40 left-0 rounded-br-3xl -upDown -z-10"></div>
                <div class="box w-40 h-24 bg-purple-600 absolute top-0 left-72 rounded-br-3xl leftRight -z-10"></div>
                <div class="box w-14 h-24 bg-purple-700 absolute top-40 left-40 rounded-br-3xl -upDown -z-20"></div>
            </div>
            <div class="design">
                <div class="box w-60 h-52 bg-purple-500 absolute left-0 bottom-0 rounded-tr-3xl shadow-2xl"></div>
                <div class="box w-40 h-28 bg-purple-700 absolute left-60 bottom-0 rounded-tr-3xl shadow-2xl leftRight -z-10"></div>
                <div class="box w-40 h-28 bg-purple-700 absolute left-0 bottom-52  rounded-tr-3xl shadow-2xl upDown -z-10"></div>
                <div class="box w-14 h-14 bg-purple-800 absolute left-60 bottom-28 rounded-tr-3xl shadow-2xl upDown -z-20"></div>
                <div class="box w-14 h-14 bg-purple-800 absolute left-40 bottom-52  rounded-tr-3xl shadow-2xl leftRight -z-20"></div>

                <div class="box w-60 h-52 bg-purple-500 absolute right-0 bottom-0 rounded-tl-3xl shadow-2xl"></div>
                <div class="box w-40 h-28 bg-purple-700 absolute right-60 bottom-0 rounded-tl-3xl shadow-2xl -leftRight -z-10"></div>
                <div class="box w-40 h-28 bg-purple-700 absolute right-0 bottom-52  rounded-tl-3xl shadow-2xl upDown -z-10"></div>
                <div class="box w-14 h-14 bg-purple-800 absolute right-60 bottom-28 rounded-tl-3xl shadow-2xl upDown -z-20"></div>
                <div class="box w-14 h-14 bg-purple-800 absolute right-40 bottom-52  rounded-tl-3xl shadow-2xl -leftRight -z-20"></div>
            </div>

        </div>
    </div>



</x-layout>