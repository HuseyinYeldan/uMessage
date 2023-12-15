@props(['buttonText'])
<input type="submit" value="{{ $buttonText }}"  {{ $attributes->merge(['class'=>'w-full h-10 mt-2 rounded-md text-white font-bold text-xl bg-purple-500 cursor-pointer'])}}>