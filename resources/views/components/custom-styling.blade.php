@if($primaryColor || $accentColor)
<style nonce='{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce('style') }}'>
:root {
    @if($primaryColor)
        --primary-color: {{ $primaryColor }};
    @endif
    @if($accentColor)
        --accent-color: {{ $accentColor }};
    @endif
}
</style>
@endif
