@props(['link','name'])
<a href="{{ $link }}" class="@if(Request::path() ==  Str::lower($name))) font-semibold border-b-4 border-purple-500 @endif py-3 px-2">{{ $name }}</a>
