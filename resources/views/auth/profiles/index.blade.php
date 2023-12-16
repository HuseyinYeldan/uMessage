<x-layout>

    <x-navigation />

    
    <div class="w-full flex justify-center items-center flex-col">
        <div class="w-3/5 lg:w-full">
            <div class="feed px-[20%] flex flex-col justify-center items-center lg:px-[5%]">
                @foreach ($users as $user)
                <div class="post flex w-full mt-8 mb-8 p-4 shadow-md duration-300 rounded hover:ring-2 relative hover:ring-purple-100">
                    <img src="/storage/{{ $user->avatar }}" class="rounded-full w-12 h-12 aspect-square mr-4 flex-shrink-0" alt="">
                
                    <div class="post-info flex justify-start flex-col">
                        <a href="/p/{{ $user->username }}" class="font-semibold duration-300 hover:text-purple-600">{{ '@'.$user->username }}</a>
                        <p class="text-xs text-gray-400 mt-1"> <i class="fa-regular fa-clock"></i> {{ $user->created_at->isToday() ? 'Account created '. $user->created_at->diffForHumans() : 'Account created at '. $user->created_at->format('F jS Y - H:m')}} </p>
                        <a href="/p/{{ $user->username }}" class="bg-purple-500 py-1 text-center text-white rounded font-bold mt-2 text-sm">User Details</a>
                    </div>
                    <div class="post-other absolute right-2">
                        <i class="fa-solid fa-ellipsis cursor-pointer text-xl"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layout>
