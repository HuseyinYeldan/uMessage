@props(['name','labelText','placeholder','type'])
<div class="form-container w-full p-2 flex flex-col justify-start items-start">
    <label for="{{ $name }}" class="mb-1">{{ $labelText }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="w-80 rounded-md p-2 border border-gray-400 duration-200 bg-white backdrop-blur-[2px] bg-opacity-10 outline-none focus:border-purple-500 focus:text-purple-500 placeholder:text-sm" placeholder="{{ $placeholder }}"/>
</div>