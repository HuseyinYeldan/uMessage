@props(['name','labelText','placeholder','type'])
<div class="form-container w-full p-2 flex justify-between items-center">
    <label for="{{ $name }}" class="mr-4">{{ $labelText }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="w-60 rounded-md p-2 border duration-200 bg-white backdrop-blur-[2px] bg-opacity-10 outline-none focus:border-cyan-500 focus:text-cyan-500" placeholder="{{ $placeholder }}"/>
</div>