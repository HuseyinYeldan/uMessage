@props(['link'])
<a href="{{ $link }}" class="text-sm text-white ring-2 ring-purple-500  font-bold rounded px-8 py-2 duration-200 hover:bg-purple-500">{{ $slot }}</a>