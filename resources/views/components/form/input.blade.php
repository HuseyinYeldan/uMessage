@props(['name','labelText','placeholder','type'])
<div class="form-container w-full flex flex-col justify-start items-start mb-4 ">
    <label for="{{ $name }}" class="mb-1 @error($name) text-red-500 @enderror ">{{ $labelText }}:</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" {{ $attributes }} class="w-80 text-sm rounded-md p-2 border border-gray-400 duration-200 bg-white backdrop-blur-[2px] bg-opacity-10 outline-none focus:border-purple-500 focus:text-purple-500 placeholder:text-sm @error($name) border-red-400 bg-red-400 placeholder:text-red-300 @enderror " placeholder="{{ $placeholder }}"/>
    @error($name)
        <p class='text-xs text-red-500'>{{ $message }}</p>
    @enderror
</div>