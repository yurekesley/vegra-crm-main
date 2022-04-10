@props(['active', 'text'])

@php
$aClasses = $active ?? false ? 'bg-red-700 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md' : 'text-red-300 hover:bg-red-800 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md';
$svgClasses = $active ?? false ? 'flex-shrink-0 w-6 h-6 mr-4 text-red-300' : 'flex-shrink-0 w-6 h-6 mr-4 text-red-400 group-hover:text-red-300';
@endphp

<a {{ $attributes->merge(['class' => $aClasses]) }}>
    <svg class="{{ $svgClasses }}" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        {{ $svgIcon }}
    </svg>
    {{ __($text) }}
</a>
