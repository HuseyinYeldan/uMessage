@props(['name','placeHolder'])
<textarea name="{{ $name }}" id="{{ $name }}"
class="share-post flex w-full h-40 mt-4 p-4 shadow-md border border-gray-400  duration-300 rounded outline-none resize-none hover:ring-2 hover:ring-purple-300 @error($name) border-red-400 bg-red-50 placeholder:text-red-300 @enderror focus:bg-white focus:border-gray-500"
placeholder="{{ $placeHolder }}" {{ $attributes }}>{{ $slot }}</textarea>
@error($name)
<p class='text-xs w-full mt-2 text-center text-red-500'>{{ $message }}</p>
@enderror