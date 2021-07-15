@props(['name', 'checked' => false, 'label','hint' => null])
<input
    type="checkbox"
    name="{{ $name }}"
    class="checkbox-input"
    {{ old($name, $checked) ? 'checked' : '' }}
    hidden
    id="{{ $name }}"
/>
<label class="checkbox-input-label" for="{{ $name }}">
    <span class="ml-2">@lang($label)</span>
    <div class='ml-7 w-full'>
        @error($name)
        <span class="text-failure text-sm font-normal">{{ $message }}</span>
        @elseif($hint)
        <span class='text-gray-600 text-sm font-normal'>{{ $hint }}</span>
        @enderror
    </div>
</label>
