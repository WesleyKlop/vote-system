@props(['hint', 'label', 'name', 'value' => null, 'placeholder', 'type' => 'text', 'required' => false])
<label {{ $attributes->merge(['class' => 'input-label']) }}>
    @lang($label)
    <input
        type="{{ $type }}"
        {{ $required ? 'required' : '' }}
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        class="input"
        placeholder="@lang($placeholder)"
    />
    @error($name)
    <span class="text-failure text-sm font-normal">{{ $message }}</span>
    @enderror
</label>
