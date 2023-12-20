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



</x-layout>
