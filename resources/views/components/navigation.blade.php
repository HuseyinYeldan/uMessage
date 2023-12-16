<div class="navigation w-full h-12 mb-10 shadow px-[20%] flex justify-between items-center lg:px-[5%]">
    <a href="/feed" class="cursive text-purple-600 text-2xl font-bold flex-1 md:flex-auto" >uMessage</a>

    <nav class="flex-1 md:text-sm md:flex-auto">
        <x-nav-link link='/feed' name='Feed' />
        <x-nav-link link='/profiles' name='Profiles' />
    </nav>

    <div class="nav-user flex justify-center items-center relative ">
        <button class="text-sm font-semibold mr-4" id="userButton">
            <img src="storage/{{ Auth::user()->avatar }}" alt=""
                class="inline rounded-full w-8 h-8 aspect-square object-cover" width="50" height="50">
            <span class="md:hidden">{{ Auth::user()->username }}</span>
            <i class="fa-solid fa-angle-down duration-200" id='navUserDropdownIcon'></i>
        </button>
        <div id="navUserDropdown"
            class="w-40 bg-white shadow-md absolute top-10 rounded-b duration-300 hidden justify-center items-center flex-col gap-4 p-2">
            <a href="/profile" class="w-full text-gray-800 text-xs font-semibold rounded"><i
                    class="fa-solid fa-user"></i> Profile</a>
            <a href="/settings" class="w-full text-gray-800 text-xs font-semibold rounded"><i
                    class="fa-solid fa-gear"></i> Settings</a>
            <form action="/logout" method="post">
                @csrf
                <button type="submit"
                    class="text-sm w-full bg-red-400 rounded ring-2 ring-red-300 font-bold px-12 py-1 text-white">Logout</button>
            </form>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
