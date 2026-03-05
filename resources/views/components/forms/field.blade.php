@props([
    'label',
    'name',
    'type' => 'text'
])


<div class="space-y-2">
    <label class="label" for="{{ $name }}">{{ $label }}</label>
    <input value="{{ old($name) }}" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="input" {{ $attributes }} />

    @error($name)
        <p class="error">{{ $message }}</p>
    @enderror
</div>
