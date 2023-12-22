@php
    $url = url()->current();
    $pathSegments = explode('/', parse_url($url, PHP_URL_PATH));
    $mainPart = isset($pathSegments[1]) ? $pathSegments[1] : '/';
@endphp

@props(['link','name'])
<a href="{{ $link }}" class="@if($mainPart ==  Str::lower($name))) font-semibold border-b-4 border-purple-500 @endif py-3 px-2">{{ $name }}</a>
