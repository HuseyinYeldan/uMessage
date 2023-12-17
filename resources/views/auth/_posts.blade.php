@foreach ($posts as $post)
<div class="post flex w-full mt-8 mb-8 p-4 shadow-md border border-gray-200 duration-300 rounded hover:ring-2 relative hover:ring-purple-300">
    <img src="/storage/{{ $post->user->avatar }}" class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0" alt="">

    <div class="post-info flex justify-start flex-col">
        <a href="/p/{{ $post->user->username }}" class="font-semibold duration-300 hover:text-purple-600">{{ '@'.$post->user->username }}</a>
        <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i> {{ $post->created_at->isToday() ? 'posted '. $post->created_at->diffForHumans() : 'posted at '. $post->created_at->format('F jS Y - H:m')}} @if($post->created_at != $post->updated_at) | Edited @endif </p>
        <p class="text-sm my-2 break-all">{{ $post->body }}</p>
        <span class="text-xs mt-2 flex items-center">
            <i class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400" class="likeButton"></i> <span>23 likes</span>
            <i class="fa-regular fa-comment text-xl ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-600" class="likeButton"></i> <span>3 comments</span>
        </span>
    </div>

    <div class="post-other absolute right-2">
        <button class="profileOther w-8 h-8 duration-300 hover:text-purple-600"><i class="fa-solid fa-ellipsis text-xl relative -z-20"></i></button>
        <div class="absolute hidden w-24 h-16 rounded flex-col bg-white shadow-md after:w-4 after:h-4 after:bg-yellow-400 after:rounded after:absolute after:-top-2 after:left-2 after:rotate-45 after:-z-30">
            <a href="" class="flex rounded-t justify-center items-center flex-1 text-center duration-300 bg-yellow-400 font-bold text-xs text-yellow-900 hover:bg-yellow-500 ">Edit Post</a>
            <a href="" class="flex rounded-b justify-center items-center flex-1 text-center duration-300 bg-red-400 font-bold text-red-900 text-xs hover:bg-red-500">Delete Post</a>
        </div>
    </div>
</div>
@endforeach


<script>
    let profileOther = document.querySelectorAll('.profileOther');

    profileOther.forEach((button) => {
        button.addEventListener('click', (e) => {
            const menu = e.currentTarget.nextElementSibling;

            profileOther.forEach((otherButton) => {
                const otherMenu = otherButton.nextElementSibling;
                if (otherMenu !== menu) {
                    otherMenu.classList.remove('flex');
                    otherMenu.classList.add('hidden');
                }
            });

            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');

            // Add event listener to close the menu when clicking outside
            document.addEventListener('click', closeMenuOutside);
        });
    });

    function closeMenuOutside(e) {
        if (!e.target.closest('.post-other')) {
            profileOther.forEach((button) => {
                const menu = button.nextElementSibling;
                menu.classList.remove('flex');
                menu.classList.add('hidden');
            });

            document.removeEventListener('click', closeMenuOutside);
        }
    }
</script>
