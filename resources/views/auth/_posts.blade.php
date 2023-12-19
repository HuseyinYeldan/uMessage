@foreach ($posts as $post)
    <div class="post flex w-full mt-8 p-4 shadow-md border border-gray-200 duration-300 rounded relative">
        <img src="{{ $post->user->avatar }}" class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0"
            alt="">

        <div class="post-info flex justify-start flex-col">
            <a href="/p/{{ $post->user->username }}"
                class="font-semibold duration-300 hover:text-purple-600">{{ '@' . $post->user->username }}</a>
            <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i>
                {{ $post->created_at->isToday() ? 'posted ' . $post->created_at->diffForHumans() : 'posted at ' . $post->created_at->format('F jS Y - H:m') }}
                @if ($post->created_at != $post->updated_at)
                    | Edited
                @endif
            </p>
            <p class="text-sm my-2 break-all">{{ $post->body }}</p>
            <span class="text-xs mt-2 flex items-center">
                <button class="likeButton flex items-center"> <i
                        class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"></i>
                    <span>23 likes</span> </button>
                <button class="commentButton flex items-center"> <i
                        class="fa-regular fa-comment text-xl ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-600"></i>
                    <span> {{ count($post->comments) }} comments</span> </button>
            </span>
        </div>

        <div class="post-other absolute right-2">
            <button class="profileOther w-8 h-8 duration-300 hover:text-purple-600"><i
                    class="fa-solid fa-ellipsis text-xl relative -z-20"></i></button>
            <div
                class="absolute hidden w-24 rounded flex-col bg-white shadow-md after:w-4 after:h-4 after:bg-gray-500 after:rounded after:absolute after:-top-2 after:left-2 after:rotate-45 after:-z-30">
                @if (Auth::user()->id === $post->user->id)
                    <a href=""
                        class="flex rounded-t justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-yellow-500 ">Edit
                        Post</a>
                    <a href=""
                        class="flex           justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-red-500">Delete
                        Post</a>
                @endif
                <a href=""
                    class="flex rounded-b justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-blue-500">Report
                    Post</a>
            </div>
        </div>

    </div>
    <div class="comments duration-300 shadow-inner w-full hidden p-4 mb-8 bg-white border border-gray-200 rounded-b">
        <div class="mb-4">
            <form action="/" method="post">
                @csrf
                <a href="#" class="flex mb-2 items-center w-fit"><img src="/storage/{{ Auth::user()->avatar }}" class="w-8 h-8 shadow-md rounded-full flex-shrink-0 mr-2 bg-white" alt=""> <span class="duration-300 font-bold hover:text-purple-700"> {{ '@'.Auth::user()->username }} </span> </a>
                <textarea name="content" placeholder="Comment to this post" maxlength="500" class="border outline-none focus:border-purple-300 placeholder:text-sm text-sm resize-none w-full p-2"></textarea>
                <button type="submit" class="bg-purple-500 text-white text-xs px-4 py-2">Comment</button>
            </form>
        </div>
        @foreach ($post->comments->where('parent_id', null) as $comment)
            @include('auth.partials.comment', ['comment' => $comment])
        @endforeach
    </div>

@endforeach

<script>
    function toggleComments(post) {
        const commentsContainer = post.nextElementSibling;
        // Check if commentsContainer exists
        if (commentsContainer) {
            commentsContainer.classList.toggle('hidden');
        }
    }

    // Event listener for comment buttons
    document.addEventListener('click', function(e) {
        const clickedButton = e.target.closest('.commentButton');

        // Check if the click target is a comment button
        if (clickedButton) {
            const post = clickedButton.closest('.post');

            // Check if a post element is found
            if (post) {
                toggleComments(post);
            }
        }
    });
</script>
