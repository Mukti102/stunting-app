@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
])

<div class="form-group {{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <select {{ $errors->has($name) ? 'is-invalid' : '' }} class="js-example-basic-single select2 form-control" name="{{ $name }}" id="{{ $name }}">
        {{-- Placeholder option --}}
        <option selected="selected">{{ $placeholder }}</option>
        {{ $slot }}
    </select>

    {{-- Error message --}}
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
