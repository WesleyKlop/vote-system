@props(['name', 'checked' => false, 'label'])
<input
    type="checkbox"
    name="{{ $name }}"
    class="checkbox-input"
    {{ old($name, $checked) ? 'checked' : '' }}
    hidden
    id="{{ $name }}"
/>
<label class="checkbox-input-label" for="{{ $name }}">
    <span class="checkbox-input-text">@lang($label)</span>
    @error($name)
    <span class="text-failure text-sm font-normal">{{ $message }}</span>
    @enderror
</label>
