<x-layout>

    <x-navigation />

    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">

            <div class="feed px-[20%] flex flex-col lg:px-[5%]">
                <label for="body" class="text-sm text-center font-bold flex justify-center items-center">Share your
                    message with <span class="cursive text-purple-600 font-bold text-xl ml-1"> uMessage</span> </label>
                <a href="/p/{{ Auth::user()->username }}" class="text-sm w-fit flex items-center">
                    <img src="/storage/{{ Auth::user()->avatar }}" class="w-8 h-8 mr-1 aspect-square rounded-full"
                        alt="">
                    <span class="font-bold">{{ Auth::user()->username }}</span>
                </a>
                <div class="w-full mt-1 flex justify-center items-center">
                    <button class="flex-1 rounded-tl text-sm text-purple-200 font-bold py-1 bg-purple-600 hover:text-purple-200 hover:bg-purple-500 postTypeButton">Text</button>
                    <button class="flex-1 rounded-tr text-sm text-purple-600 font-bold py-1 bg-purple-200 duration-300 hover:text-purple-200 hover:bg-purple-500 postTypeButton">Image</button>
                </div>
                <form action="/share-post" method="post" class="w-full ml flex justify-center flex-col" id="sharePost" enctype="multipart/form-data">
                    @csrf
                    <x-form.textarea name='body' placeHolder="What's on your mind?" maxlength='500' style="margin-top:0" />
                    <div class="w-full justify-center items-center relative bg-purple-50 hidden" id="postImageBox">
                        <input type="file" class="w-full h-full absolute z-20 opacity-0 cursor-pointer" name="image" id="postImage" onchange="previewImage(this);">
                        <i class="fa-solid fa-square-plus z-10 absolute text-4xl w-1/4 h-1/4 text-purple-500 opacity-80 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2"></i>
                        <img src="https://via.placeholder.com/2000x1000" class="static top-0 w-full h-full" id="imagePreview" alt="">
                    </div>
                
                    <div class="progress w-0 h-0 duration-300 bg-purple-600" id="progress"></div>
                    <p class="text-xs h-0 duration-300" id="charCount"></p>
                    <div class="w-full"><x-form.submit buttonText='Share' /></div>
                </form>

                <div class="flex w-full justify-center items-center mt-4 gap-4">
                    <x-filter-button name='popular' />
                    <x-filter-button name='newest' />
                    <x-filter-button name='oldest' />
                    <x-filter-button name='controversial' />
                </div>
                <form action="{{ route('search.post') }}" method="post" class="flex w-full justify-center items-center mt-4">
                    @csrf
                    <input type="text" name="search" minlength="1" maxlength="64" class="text-sm flex-[15] p-2 outline-none duration-300 focus:border-purple-500 rounded border border-gray-200" placeholder="Search...">
                    <button id="search" type="submit" class="flex-1"> <div class="fa-solid fa-search"></div> </button>
                </form>
                @error('search')
                <p class="text-xs w-full text-center py-1 bg-red-100 text-red-500">{{ $message }}</p>
                @enderror

                @if ($posts->isEmpty())
                    <p class="mt-2 w-full bg-yellow-400 text-yellow-800 font-bold text-sm text-center p-2 rounded break-all"> <i class="fa-solid fa-times"></i> No posts found for {{ $searchTerm }}... </p>
                @endif
                <div id="posts-container" class="flex w-full flex-col justify-center items-center">
                    @include('auth._posts')
                    <div id="loading-indicator"
                        class="hidden fixed z-50 bottom-4 bg-purple-500 px-8 py-2 rounded text-white font-semibold justify-center items-center gap-2">
                        <i class="fa-solid fa-spinner fa-spin text-white"></i> Loading...
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script>

        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                document.getElementById('postImageBox').classList.remove('hidden');
            } else {
                preview.src = "https://via.placeholder.com/2000x500";
                document.getElementById('postImageBox').classList.add('hidden');
            }
        }

        $('.postTypeButton').on('click', function () {
            // Check if the clicked button is the "Image" button
            var isImageButton = $(this).text().trim() === 'Image';

            // Toggle the visibility of the image box based on the button clicked
            $('#postImageBox').toggleClass('hidden', !isImageButton);

            // Toggle the styling of the buttons
            $('.postTypeButton').removeClass('bg-purple-600 text-purple-200').addClass('bg-purple-200 text-purple-600');
            $(this).removeClass('bg-purple-200 text-purple-600').addClass('bg-purple-600 text-purple-200');


        });



        let shareTextArea = document.getElementById('body');
        let charCount = document.getElementById('charCount');
        let progress = document.getElementById('progress');

        shareTextArea.addEventListener('keyup', function() {

            let messageLength = shareTextArea.value.length;
            charCount.style.height = '10px'
            progress.style.height = '10px'

            charCount.innerText = `Character Count: ${messageLength}/500`
            progress.style.width = `${messageLength/5}%`
            if (shareTextArea.value.length == 500) {
                progress.classList.remove('bg-purple-600')
                charCount.classList.remove('text-orange-400')
                progress.classList.remove('bg-orange-400')
                charCount.classList.add('text-red-500')
                progress.classList.add('bg-red-400')
            } else if (shareTextArea.value.length >= 450) {
                progress.classList.remove('bg-purple-600')
                charCount.classList.remove('text-red-500')
                progress.classList.remove('bg-red-400')
                charCount.classList.add('text-orange-400')
                progress.classList.add('bg-orange-400')
            } else if (shareTextArea.value.length == 0) {
                charCount.innerText = ''
                charCount.style.height = '0px'
                progress.style.height = '0px'
            } else {
                progress.classList.add('bg-purple-600')
                charCount.classList.remove('text-red-500')
                progress.classList.remove('bg-red-400')
                charCount.classList.remove('text-orange-400')
                progress.classList.remove('bg-orange-400')
            }

        })
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
                        $('#loading-indicator').addClass('hidden');
                        if (noMoreRecords) {
                            $('#posts-container').append(
                                `<div id="no-more-records" class="text-gray-600 font-semibold my-4">You've reached to the end.</div>`
                            );
                        }
                        loading = false; // Set loading back to false to allow the next request
                    }
                });
            }

            
            $('#sharePost').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '/share-post',
                    data: formData,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        // Prepend the new post HTML to the posts container
                        $('#posts-container').prepend(result.html);

                        // Reset form and other elements
                        $('#sharePost')[0].reset();
                        let charCount = document.getElementById('charCount');
                        let progress = document.getElementById('progress');
                        charCount.innerText = '';
                        charCount.style.height = '0px';
                        progress.style.height = '0px';
                    }
                });
            });

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



    <script>
        var profileOther = document.querySelectorAll('.profileOther');

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('profileOther')) {
                const menu = e.target.nextElementSibling;

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
            }

        })

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


</x-layout>
