@props([
    'label' => false,
    'name',
    'type' => 'text',
    'value' => ''
])

<div class="space-y-2">
    @if ($label)
        <label class="label" for="{{ $name }}">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            class="textarea"
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>    
    @else
        <input 
            value="{{ old($name, $value) }}" 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            class="input" 
            {{ $attributes }} 
        />
    @endif

    <x-forms.error name="{{ $name }}"/>
</div>