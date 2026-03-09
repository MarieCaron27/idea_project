@props([
    'label' => false,
    'name',
    'type' => 'text'
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
        >{{ old($name) }}</textarea>    
    @else
        <input 
            value="{{ old($name) }}" 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            class="input" 
            {{ $attributes }} 
        />
    @endif

    <x-forms.error name="{{ $name }}"/>
</div>
