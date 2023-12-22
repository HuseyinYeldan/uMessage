@props(['name'])
<a href="/feed/{{ $name }}" class="flex-1 text-center py-2 text-xs font-bold rounded duration-300 hover:bg-purple-600 hover:text-purple-200 
{{ Str::lower(Request::path()) ==  'feed/'.Str::lower($name)? 'bg-purple-600 text-purple-200':'bg-purple-200 text-purple-500'  }}"> {{ ucwords($name) }} </a>
