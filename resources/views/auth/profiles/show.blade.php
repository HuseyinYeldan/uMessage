<x-layout>

    <x-navigation />

    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">
            <div class="flex mb-4 flex-col shadow-md p-4">
                <h2 class="text-4xl font-bold text-center">{{ '@' . $user->username }}</h2>
                <div id="posts-container" class="flex w-full flex-col justify-center items-center">
                    @include('auth._posts')
                    <div id="loading-indicator"
                        class="hidden fixed bottom-4 bg-purple-500 px-8 py-2 rounded text-white font-semibold justify-center items-center gap-2">
                        <i class="fa-solid fa-spinner fa-spin text-white"></i> Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            var page = 2; // Initial page number
            var loading = false; // Flag to prevent multiple simultaneous requests
            var noMoreRecords = false; // Flag to track if there are no more records

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() && !loading && !
                    noMoreRecords) {
                    loadMoreData(page);
                    page++;
                }
            });

            function loadMoreData(page) {
                loading = true; // Set loading to true to prevent multiple requests

                $('#loading-indicator').removeClass('hidden'); // Show loading indicator

                $.ajax({
                    url: '?page=' + page,
                    type: 'GET',
                    beforeSend: function() {
                        // You can add a loading spinner or message here if needed
                    },
                    success: function(data) {
                        if (data.html == "") {
                            noMoreRecords = true; // Set flag to true when there are no more records
                        } else {
                            $('#posts-container').append(data.html);
                        }
                    },
                    complete: function() {
                        $('#loading-indicator').addClass(
                            'hidden'); // Hide loading indicator after content is loaded

                        if (noMoreRecords) {
                            $('#posts-container').append(
                                `<div id="no-more-records" class="text-gray-600 font-semibold my-4">You've reached to the end.</div>`
                            );
                        }

                        loading = false; // Set loading back to false to allow the next request
                    }
                });
            }

            $('#posts-container').on('submit', '.likeForm', function (e) {
                e.preventDefault();
                var $form = $(this);

                if(!$form.find('.likeButton')[0].classList.contains('liked')){
                        $form.find('.likeButton')[0].innerHTML =
                        `
                            <i class="fa-solid fa-heart text-xl mr-1 text-red-500 duration-300 cursor-pointer hover:text-red-400"></i>
                            <span>
                                <span class='likeCount'>${ parseInt($form.find('.likeCount')[0].innerText) +1} </span> <span> likes </span>
                            </span>
                        `
                        $form.find('.likeButton')[0].classList.add('liked')

                    }
                    else{
                        $form.find('.likeButton')[0].innerHTML =
                        `
                        <i class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"></i>
                            <span>
                                <span class='likeCount'>${ parseInt($form.find('.likeCount')[0].innerText) -1} </span> <span> likes </span>
                            </span>
                        `
                        $form.find('.likeButton')[0].classList.remove('liked')
                    }

                $.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',

                    success: function(result) {

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
