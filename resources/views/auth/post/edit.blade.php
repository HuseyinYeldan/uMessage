<x-layout>

    <x-navigation />
    @if (Auth::user()->id === $post->user->id)
        
    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">
            <div class="flex mb-4 flex-col shadow-md">
                <div id="posts-container" class="flex w-full flex-col justify-center items-center">
                    <div
                        class="post flex w-full p-4 shadow-md border border-gray-200 duration-300 rounded relative">
                        <img src="/storage/{{ $post->user->avatar }}"
                            class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0 sticky top-2" alt="">

                        <div class="post-info w-full flex justify-start flex-col">
                            <a href="/p/{{ $post->user->username }}"
                                class="font-semibold duration-300 w-fit hover:text-purple-600">{{ '@' . $post->user->username }}</a>
                            <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i>
                                {{ $post->created_at->isToday() ? 'posted ' . $post->created_at->diffForHumans() : 'posted at ' . $post->created_at->format('F jS Y - H:m') }}
                                @if ($post->created_at != $post->updated_at)
                                    | Edited
                                @endif
                            </p>
                            <form action="{{ route('update.post', ['post'=>$post]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <x-form.textarea name='body' placeHolder="What's on your mind?" maxlength='500'> {{ $post->body }} </x-form.textarea>
                                <div class="progress w-0 h-0 duration-300 bg-purple-600" id="progress"></div>
                                <p class="text-xs h-0 duration-300" id="charCount"></p>
                                <div class="w-full"><x-form.submit buttonText='Share' /></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">
            <div class="flex mb-4 flex-col shadow-md">
                <div id="posts-container" class="flex w-full flex-col justify-center items-center">
                    <p class="p-4 font-bold text-gray-700 text-xl">You are not authorized to edit this post.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
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
</x-layout>
