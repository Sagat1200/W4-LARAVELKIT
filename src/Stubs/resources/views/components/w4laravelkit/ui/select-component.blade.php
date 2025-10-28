@props([
    'model',
    'options' => [],
    'placeholder' => '',
    'label' => null,
    'selectClass' => '',
    'wireChange' => null,
    'autofocus' => false,
])

@php
    $eventoLimpieza = 'limpiar-' . str_replace(['.', '[', ']'], ['-', '-', ''], $model);
@endphp

<div class="w-full max-w-xs input-group">
    @if ($label)
        <span class="block text-sm font-medium mb-1 text-base-content">{{ $label }}</span>
    @endif

    <select
        x-data
        x-ref="select"
        x-on:{{ $eventoLimpieza }}.window="
            $refs.select.value = '';
            $dispatch('input', '');
        "
        x-init="{{ $autofocus ? '$nextTick(() => $refs.select.focus())' : '' }}"
        wire:model.live="{{ $model }}"
        @if ($wireChange) wire:change="{{ $wireChange }}" @endif
        {{ $attributes->class([
            'select select-sm bg-base-100 text-base-content border border-primary focus:outline-none',
            $selectClass,
        ]) }}
    >
        <option value="">{{ __($placeholder) }}</option>

        @foreach ($options as $key => $text)
            <option value="{{ $key }}">{{ $text }}</option>
        @endforeach
    </select>

    @error($model)
        <span class="text-error text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>



{{-- $this->dispatch('limpiar-estadoCivil'); --}}

{{-- @include('components.w4laravelkit.ui.select-component', [
    'wire:model' => 'tipo_domicilio',
    'model' => 'tipo_domicilio',
    'options' => [
        'PROPIO',
        'RENTADO',
    ],
    'placeholder' => 'TIPO DE DOMICILIO'
]) --}}

{{-- <x-w4laravelkit.ui.select-component wire:model="tipo_domicilio" model="tipo_domicilio" :options="[
    'PROPIO', 
    'RENTADO',
    ]"
    placeholder="TIPO DE DOMICILIO" /> --}}

{{-- @include('components.w4laravelkit.ui.select-component', [
    'wire:model' => 'tipo_domicilio',
    'model' => 'tipo_domicilio',
    'options' => [
        'PROPIO',
        'RENTADO',
    ],
    'placeholder' => 'TIPO DE DOMICILIO'
]) --}}

{{-- <x-w4laravelkit.ui.select-component wire:model="tipo_domicilio" model="tipo_domicilio" :options="[
    'PROPIO', 
    'RENTADO',
    ]"
    placeholder="TIPO DE DOMICILIO" /> --}}
