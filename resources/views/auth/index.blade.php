<x-layout>

    <div class="navigation w-full h-12 mb-10 shadow px-[20%] flex justify-between items-center">
        <a href="/feed" class="cursive text-purple-600 text-2xl font-bold">uMessage</a>

        <nav>
            <x-nav-link link='/feed' name='Feed' />
            <x-nav-link link='/profiles' name='Profiles' />
        </nav>

        <div class="nav-user flex justify-center items-center relative">
            <button class="text-sm font-semibold mr-4" id="userButton">
                <img src="storage/{{ Auth::user()->avatar }}" alt=""
                    class="inline rounded-full w-8 h-8 aspect-square object-cover" width="50" height="50">
                {{ Auth::user()->username }}
                <i class="fa-solid fa-angle-down"></i>
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

    <div class="feed px-[20%] flex flex-col justify-center items-center">
        <label for="body" class="text-sm font-bold">Share your message</label>
        <p class="text-xs">You are posting as <span class="font-bold">{{ Auth::user()->username }}</span> </p>
        <textarea name="body" id="body"
            class="share-post flex w-3/5 h-40 mt-4 p-4 shadow-md border border-gray-400  duration-300 rounded outline-none resize-none hover:ring-2 hover:ring-purple-300"
            placeholder="What's on your mind?"></textarea>
        <div class="w-3/5"><x-form.submit buttonText='Share' /></div>


        <div id="posts-container" class="flex flex-col justify-center items-center">
            @include('auth._posts')
            <div id="loading-indicator" class="hidden">
                <!-- You can use your preferred loading spinner here -->
                <i class="fa-solid fa-spinner fa-spin text-2xl text-gray-500"></i> Loading...
            </div>
            <div id="no-more-records" class="hidden">No more records found.</div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        #loading-indicator {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
        }

        #no-more-records {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
        }
    </style>

    <script>
        $(document).ready(function() {
            var page = 2; // Initial page number
            var loading = false; // Flag to prevent multiple simultaneous requests

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() && !loading) {
                    loadMoreData(page);
                    page++;
                }
            });

            function loadMoreData(page) {
                loading = true; // Set loading to true to prevent multiple requests

                $('#loading-indicator').removeClass('hidden'); // Show loading indicator
                $('#no-more-records').addClass('hidden'); // Hide "No more records" message (if visible)

                $.ajax({
                    url: '?page=' + page,
                    type: 'GET',
                    beforeSend: function() {
                        // You can add a loading spinner or message here if needed
                    },
                    success: function(data) {
                        if (data.html == "") {
                            $('#no-more-records').removeClass(
                            'hidden'); // Show "No more records" message
                        } else {
                            $('#posts-container').append(data.html);
                        }
                    },
                    complete: function() {
                        $('#loading-indicator').addClass(
                        'hidden'); // Hide loading indicator after content is loaded
                        loading = false; // Set loading back to false to allow the next request
                    }
                });
            }
        });
    </script>


</x-layout>
