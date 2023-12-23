<x-layout>

    <x-navigation />

    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">
            <div class="flex mb-4 flex-col shadow-md">
                <div id="posts-container" class="flex w-full flex-col justify-center items-center">

                    <div class="post flex w-full p-4 shadow-md border border-gray-200 duration-300 rounded relative">
                        <img src="/storage/{{ $post->user->avatar }}"
                            class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0 sticky top-2" alt="">

                        <div class="post-info flex justify-start flex-col">
                            <a href="/p/{{ $post->user->username }}"
                                class="font-semibold duration-300 w-fit hover:text-purple-600">{{ '@' . $post->user->username }}</a>
                            <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i>
                                {{ $post->created_at->isToday() ? 'posted ' . $post->created_at->diffForHumans() : 'posted at ' . $post->created_at->format('F jS Y - H:m') }}
                                @if ($post->created_at != $post->updated_at)
                                    | Edited
                                @endif
                            </p>
                            <p class="text-sm my-2 break-all">{{ $post->body }}</p>
                            @if ($post->image)
                            <img src="/storage/{{ $post->image }}" alt="" class="w-full">
                        @endif
                            <span class="text-xs mt-2 flex items-center">
                                <form action="{{ route('like', ['isComment' => 0, 'content_id' => $post->id]) }}"
                                    class="likeForm" method="post">
                                    @csrf
                                    @if (count(
                                            $post->likes->where('user_id', Auth::user()->id)->where('content_id', $post->id)->where('isComment', 0)))
                                        <button type="submit" class="likeButton liked flex items-center">

                                            <i
                                                class="fa-solid fa-heart text-xl mr-1 text-red-500 duration-300 cursor-pointer hover:text-red-400"></i>
                                        @else
                                            <button type="submit" class="likeButton flex items-center">

                                                <i
                                                    class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"></i>
                                    @endif
                                    <span>
                                        <span class="likeCount">
                                            {{ number_format(count($post->likes->where('content_id', $post->id)->where('isComment', 0))) }}</span>
                                        likes</span>
                                    </button>
                                </form> <button class="commentButton flex items-center"> <i
                                        class="fa-regular fa-comment text-xl ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-600"></i>
                                    <span> {{ count($post->comments) }} comments</span> </button>
                            </span>
                        </div>
                        <div class="post-other absolute right-2 z-30">
                            <button class="profileOther w-8 h-8 duration-300 hover:text-purple-600"><i
                                    class="fa-solid fa-ellipsis text-xl relative -z-20"></i></button>
                            <div
                                class="absolute hidden w-24 right-0 rounded flex-col bg-white shadow-md after:w-4 after:h-4 after:bg-gray-500 after:rounded after:absolute after:-top-2 after:right-2 after:rotate-45 after:-z-30">
                                @if (Auth::user()->id === $post->user->id)
                                    <a href="/m/edit/{{ $post->id }}"
                                        class="flex rounded-t justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-yellow-500 ">Edit
                                        Post</a>
                                    <form action="{{ route('delete.post', ['post' => $post]) }}" method="post"
                                        class="flex justify-center items-center flex-1 text-center ">
                                        <button type="submit"
                                            class="w-full duration-300 py-2 font-bold text-xs text-white bg-gray-500 hover:bg-red-500">
                                            @csrf
                                            @method('DELETE')
                                            Delete Post
                                        </button>
                                    </form>
                                @endif
                                <a href=""
                                    class="flex rounded-b justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-blue-500">Report
                                    Post</a>
                            </div>
                        </div>


                    </div>
                    <div
                        class="comments duration-300 shadow-inner w-full  p-4 bg-white border border-gray-200 rounded-b relative overflow-hidden z-10">
                        <div class="mb-2">
                            <form action="{{ route('post.comment', ['post' => $post->id]) }}" method="post"
                                class="commentForm">
                                @csrf
                                <a href="/p/{{ Auth::user()->username }}" class="flex mb-2 items-center w-fit"><img
                                        src="/storage/{{ Auth::user()->avatar }}"
                                        class="w-8 h-8 shadow-md rounded-full flex-shrink-0 mr-2 bg-white"
                                        alt=""> <span
                                        class="duration-300 text-sm font-bold hover:text-purple-700">
                                        {{ '@' . Auth::user()->username }} </span> </a>
                                <textarea name="content" placeholder="Comment to this post" maxlength="500"
                                    class="border outline-none focus:border-purple-300 placeholder:text-sm text-sm resize-none w-full p-2"></textarea>
                                <button type="submit"
                                    class="bg-purple-500 text-white text-xs px-4 py-2">Comment</button>
                            </form>
                        </div>
                        @foreach ($post->comments->where('parent_id', null)->sortByDesc('likes') as $comment)
                            @include('auth.partials.comment', ['comment' => $comment])
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Attach event listener for comment form submissions
            $('#posts-container').on('submit', '.commentForm', function(e) {
                e.preventDefault();
                var $form = $(this);

                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    success: function(result) {
                        var $newComment = $(result.html);
                        $newComment.addClass('border-purple-500');
                        $form.closest('.comments').find('.commentForm').after($newComment);
                        $form[0].reset();
                    }
                });
            });


            // Attach event listener for reply form submissions
            $('#posts-container').on('submit', '.replyForm', function(e) {
                e.preventDefault();
                var $form = $(this);

                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    success: function (result) {
                        var $newComment = $(result.html);
                        var $parentComment = $form.closest('.comment');

                        // Get the current margin-left value, parse it, and add 1.5
                        var currentMLValue = parseFloat($parentComment.css('margin-left')) || 0;
                        console.log('Parent',$parentComment[0]);
                        console.log('Current margin',currentMLValue);
                        currentMLValue += 24;
                        console.log('Added margin',currentMLValue);

                        // Set the margin-left property for the new comment
                        $newComment.css('margin-left', currentMLValue + 'px');

                        $parentComment.after($newComment);
                        $form[0].reset();
                    }

                });
            });

            // Attach event listener for like form submissions
            $('#posts-container').on('submit', '.likeForm', function(e) {
                e.preventDefault();
                var $form = $(this);

                var likeButton = $form.find('.likeButton')[0];

                if (!likeButton.classList.contains('liked')) {
                    likeButton.innerHTML =
                        `<i class="fa-solid fa-heart text-xl mr-1 text-red-500 duration-300 cursor-pointer hover:text-red-400"></i>
            <span>
                <span class='likeCount'>${parseInt($form.find('.likeCount')[0].innerText) + 1} </span> <span> likes </span>
            </span>`;
                    likeButton.classList.add('liked');
                } else {
                    likeButton.innerHTML =
                        `<i class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"></i>
            <span>
                <span class='likeCount'>${parseInt($form.find('.likeCount')[0].innerText) - 1} </span> <span> likes </span>
            </span>`;
                    likeButton.classList.remove('liked');
                }

                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    success: function(result) {
                        // Handle success if needed
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });

        });
    </script>

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

    <script>
        document.addEventListener('click', function(e) {
            const clickedButton = e.target.closest('.replyButton');
            if (clickedButton) {
                const commentContainer = clickedButton.closest('.comment');
                const replyForm = commentContainer.querySelector('.replyForm');

                // Close all open reply forms
                document.querySelectorAll('.replyForm').forEach(form => {
                    if (form !== replyForm) {
                        form.classList.add('hidden');
                    }
                });

                if (replyForm) {
                    replyForm.classList.toggle('hidden');
                }
            }
        });
    </script>


    <script>
        document.addEventListener('click', function(e) {

            if (e.target.classList.contains('comment')) {
                e.target.children[1].children[1].classList.toggle('hidden')
                e.target.children[1].children[2].classList.toggle('hidden')
                e.target.children[1].children[3].classList.toggle('hidden')
                e.target.children[0].classList.toggle('h-12')
                e.target.children[0].classList.toggle('h-8')
            }

        })
    </script>




</x-layout>
