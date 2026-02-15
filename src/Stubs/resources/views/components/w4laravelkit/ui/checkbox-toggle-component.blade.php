@props([
    'label' => '',
    'checked' => false,
    'model' => '',
    'type' => 'checkbox',
    'disabled' => false,
    'class' => '',
    'value' => '',
    'indeterminate' => false,
])

@php
    $isChecked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
    $isDisabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
    $isIndeterminate = filter_var($indeterminate, FILTER_VALIDATE_BOOLEAN);
@endphp

<div class="form-control" x-data @if($model !== '' && $value === '') x-init="$nextTick(() => $wire.set('{{ $model }}', {{ $isChecked ? 'true' : 'false' }}))" @endif>
    <label class="label {{ $isDisabled ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}">
        <span class="label-text">{{ $label }}</span>
        <input
            type="{{ $type }}"
            {{ $isChecked ? 'checked' : '' }}
            {{ $isDisabled ? 'disabled' : '' }}
            @if($value !== '') value="{{ $value }}" @endif
            @if($model) wire:model.live="{{ $model }}" @endif
            x-ref="cb"
            x-init="$refs.cb.indeterminate = {{ $isIndeterminate ? 'true' : 'false' }}"
            class="toggle toggle-primary {{ $class }}"
        />
    </label>
</div>

{{-- @include('components.w4laravelkit.ui.checkbox-toggle-component', [
    'label' => 'Checkbox Toggle',
    'checked' => false,
    'model' => 'checkboxToggle',
    'type' => 'checkbox',
    'disabled' => false,
    'class' => '',
]) --}}

{{-- <x-w4laravelkit.ui.checkbox-toggle-component
    label="Checkbox Toggle"
    checked="false"
    model="checkboxToggle"
    type="checkbox"
    disabled="false"
    class="" 
/> --}}