@props(['content'])

<textarea {!! $attributes->merge(['class' => 'tiny-mce-component']) !!}>{{ $content }}</textarea>