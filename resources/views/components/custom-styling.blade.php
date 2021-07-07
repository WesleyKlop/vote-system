@if($primaryColor || $accentColor)
<style nonce='{{ csp_nonce('style') }}'>
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
