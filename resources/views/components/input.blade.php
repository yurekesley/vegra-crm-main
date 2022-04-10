@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:bg-gray-200 disabled:text-gray-500']) !!}>
@error($attributes['id'])
    <small class="text-red-700 font-sm">*{{ $message }}</small>
@enderror