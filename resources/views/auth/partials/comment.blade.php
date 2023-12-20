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
            <i class="fa-regular fa-heart text-sm mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400"
                class="commentLikeButton"></i> <span>3 likes</span>
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
    
