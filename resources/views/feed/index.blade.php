<x-layout>

    <div class="navigation w-full h-12 mb-10 shadow px-[20%] flex justify-between items-center">
        <a href="/feed" class="cursive text-purple-600 text-2xl font-bold">uMessage</a>

        <nav>
            <x-nav-link link='/feed' name='Feed' />
            <x-nav-link link='/profiles' name='Profiles' />
        </nav>

        <div class="nav-user flex justify-center items-center relative">
            <button class="text-sm font-semibold mr-4" id="userButton">
                <img src="storage/{{ Auth::user()->avatar }}" alt="" class="inline rounded-full w-8 h-8 aspect-square object-cover" width="50" height="50">
                {{ Auth::user()->username }}
                <i class="fa-solid fa-angle-down"></i> 
            </button>
            <div id="navUserDropdown" class="w-40 bg-white shadow-md absolute top-10 rounded-b duration-300 hidden justify-center items-center flex-col gap-4 p-2">
                <a href="/profile" class="w-full text-gray-800 text-xs font-semibold rounded"><i class="fa-solid fa-user"></i> Profile</a>
                <a href="/settings" class="w-full text-gray-800 text-xs font-semibold rounded"><i class="fa-solid fa-gear"></i> Settings</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="text-sm w-full bg-red-400 rounded ring-2 ring-red-300 font-bold px-12 py-1 text-white">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="feed px-[20%] flex flex-col justify-center items-center">
            <label for="body" class="text-sm font-bold">Share your message</label>
            <p class="text-xs">You are posting as <span class="font-bold">{{ Auth::user()->username }}</span> </p>
            <textarea name="body" id="body" class="share-post flex w-3/5 h-40 mt-4 p-4 shadow-md border border-gray-400  duration-300 rounded outline-none resize-none hover:ring-2 hover:ring-purple-300" placeholder="What's on your mind?"></textarea>
            <div class="w-3/5"><x-form.submit buttonText='Share'/></div>

        @foreach ($posts as $post)
        <div class="post flex w-3/5 mt-8 mb-8 p-4 shadow-md duration-300 rounded hover:ring-2 hover:ring-purple-100">
            <img src="{{ $post->user->avatar }}" class="rounded-full w-12 h-12 aspect-square mr-4" alt="">

            <div class="post-info flex justify-start flex-col">
                <a href="#" class="font-semibold duration-300 hover:text-purple-600">{{ '@'.$post->user->username }}</a>
                <i class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i> posted {{ $post->created_at->diffForHumans() }} | Edited</i>
                <p class="text-sm my-2 ">{{ $post->body }}</p>
                <span class="text-xs mt-2 flex items-center">
                    <i class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400" class="likeButton"></i> <span>{{ number_format($post->likes) }} likes</span>
                    <i class="fa-regular fa-comment text-xl ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-400" class="likeButton"></i> <span>3 comments</span>
                </span>
            </div>

            <div class="post-other">
                <i class="fa-solid fa-ellipsis cursor-pointer text-xl"></i>
            </div>
        </div>
        @endforeach
        <div class="mb-8">{{ $posts->links() }}</div>
    </div>

    

</x-layout>