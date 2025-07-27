@props(['label' => '', 'name' => '', 'value' => '', 'placeholder' => '', 'required' => false, 'disabled' => false, 'type' => 'text', 'readonly' => false])

<div class="form-group {{ $attributes->get('class') }}">
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($name, $value) }}" 
        {{ $required ? 'required' : '' }} 
        {{ $disabled ? 'disabled' : '' }} 
        {{ $readonly ? 'readonly' : ''}}
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
    />

    {{-- Error message --}}
    @error($name)
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
