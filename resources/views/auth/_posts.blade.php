@foreach ($posts as $post)
<div class="post flex w-full mt-8 mb-8 p-4 shadow-md duration-300 rounded hover:ring-2 relative hover:ring-purple-100">
    <img src="/storage/{{ $post->user->avatar }}" class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0" alt="">

    <div class="post-info flex justify-start flex-col">
        <a href="/p/{{ $post->user->username }}" class="font-semibold duration-300 hover:text-purple-600">{{ '@'.$post->user->username }}</a>
        <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i> {{ $post->created_at->isToday() ? 'posted '. $post->created_at->diffForHumans() : 'posted at '. $post->created_at->format('F jS Y - H:m')}} @if($post->created_at != $post->updated_at) | Edited @endif </p>
        <p class="text-sm my-2 break-all">{{ $post->body }}</p>
        <span class="text-xs mt-2 flex items-center">
            <i class="fa-regular fa-heart text-xl mr-1 text-slate-700 duration-300 cursor-pointer hover:text-red-400" class="likeButton"></i> <span>{{ number_format($post->likes) }} likes</span>
            <i class="fa-regular fa-comment text-xl ml-4 mr-1 text-slate-700 duration-300 cursor-pointer hover:text-purple-400" class="likeButton"></i> <span>3 comments</span>
        </span>
    </div>

    <div class="post-other absolute right-2">
        <i class="fa-solid fa-ellipsis cursor-pointer text-xl"></i>
    </div>
</div>
@endforeach