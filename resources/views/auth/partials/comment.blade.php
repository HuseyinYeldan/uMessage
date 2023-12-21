<div class="comment mt-4 flex p-2 rounded  shadow-md border border-gray-200 relative z-20 after:absolute after:w-4 after:border-[6px] after:rounded-full after:border-white after:h-full after:-left-5 after:bg-purple-100 after:cursor-pointer">
    <img src="/storage/{{ $comment->user->avatar }}" class="rounded-full h-12 aspect-square mr-4 flex-shrink-0"
        alt="">
    <div class="comment-info">
        <a href="/p/{{ $comment->user->username }}"
            class="font-semibold duration-300 text-xs hover:text-purple-600">{{ '@' . $comment->user->username }}</a>
        <p class="text-xs text-gray-500"> <i class="fa-regular fa-clock"></i> {{ $comment->created_at?->isToday() ? $comment->created_at->diffForHumans() : $comment->created_at?->format('d.m.Y - H:m') }}
            @if ($comment->created_at != $comment->updated_at)
                | Edited
            @endif </p>
        <p class="text-sm break-all">{{ $comment->content }}</p>
        <span class="text-xs mt-4 flex items-center">
            <form action="{{ route('like',['isComment'=>1, 'content_id' => $comment->id])}}" method="post" class="likeForm">
                @csrf
                    @if (count(
                            $comment->likes->where('user_id', Auth::user()->id)->where('content_id', $comment->id)->where('isComment', 1)))
                        <button type="submit" class="likeButton liked flex items-center">

                        <i
                            class="fa-solid fa-heart text-xl mr-1 text-red-500 duration-300 cursor-pointer hover:text-red-400"></i>
                    @else
                    <button type="submit" class="likeButton flex items-center">
                        <i
                            class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"></i>
                    @endif
                    <span>
                      <span class="likeCount">  {{ number_format(count($comment->likes->where('content_id', $comment->id)->where('isComment', 1))) }}</span>
                        likes</span>
                </button>            </form>

            <div class="post-other absolute right-2 top-2">
                <button class="profileOther w-8 h-8 duration-300 hover:text-purple-600"><i
                        class="fa-solid fa-ellipsis text-xl relative -z-20"></i></button>
                <div
                    class="absolute hidden w-24 right-0 z-50 rounded flex-col bg-white shadow-md after:w-4 after:h-4 after:bg-gray-500 after:rounded after:absolute after:-top-2 after:right-2 after:rotate-45 after:-z-30">
                    @if (Auth::user()->id === $comment->user_id)
                        <form action="{{ route('delete.comment',['comment'=>$comment]) }}" method="post" class="flex justify-center items-center flex-1 text-center ">
                            <button type="submit" class="w-full rounded-t duration-300 py-2 font-bold text-xs text-white bg-gray-500 hover:bg-red-500">
                                @csrf
                                @method('DELETE')
                                Delete
                            </button>
                        </form>
                    @endif
                    <a href=""
                        class="flex rounded-b justify-center items-center flex-1 text-center duration-300 py-2 bg-gray-500 font-bold text-xs text-white hover:bg-blue-500">Report</a>
                </div>
            </div>

            <button class="replyButton"><i class="fa-regular fa-comment text-sm ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-600"></i>
                 <span>Reply</span>
            </button>
        </span>
        <div class="mb-2 mt-2 replyForm hidden">
            <form action="{{ route('post.reply', ['comment' => $comment->id, 'post' => $post->id]) }}" method="post">
                @csrf
                <textarea name="content" placeholder="Reply to this comment" maxlength="500" class="border outline-none focus:border-purple-300 placeholder:text-sm text-sm resize-none w-full p-2"></textarea>
                <button type="submit" class="bg-purple-500 text-white text-xs px-4 py-2">Reply</button>
            </form>
        </div>
    </div>
</div>
</a>
@if ($comment->replies->count() > 0)
<div class="reply-container relative">
    <div class="ml-6 mt-4">
        @foreach ($comment->replies as $reply)
            @include('auth.partials.comment', ['comment' => $reply])
        @endforeach
    </div>
</div>
@endif
    
