@props(['type' => 'submit'])
<button type='{{ $type }}' class='{{ $type }}-button self-start'>
    {{ $slot }}
</button>
