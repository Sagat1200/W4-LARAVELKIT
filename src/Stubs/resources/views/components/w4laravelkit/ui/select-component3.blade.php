@props([
    /**
     * @var string Wire model binding (e.g. "fields.name")
     */
    'model',
    /**
     * @var array<optionValue => optionLabel>
     */
    'options' => [],
    /**
     * @var string Placeholder shown when no option selected
     */
    'placeholder' => '',
    /**
     * @var string Optional label above the select
     */
    'label' => null,
    /**
     * @var bool Use wire:model.defer instead of wire:model
     */
    'defer' => true,
    /**
     * @var string Optional wire:change event
     */
    'wireChange' => null,
])

<div class="w-full max-w-xs input-group">
@if ($label)
    <span class="block text-sm font-medium mb-1 text-base-content">{{ $label }}</span>
@endif

    <select
        @if($defer)
            wire:model.defer="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif

           @if($wireChange)
            wire:change="{{ $wireChange }}"
        @endif
        {{ $attributes->class([
    'select select-sm bg-base-100 text-base-content border border-primary focus:outline-none',
]) }}
    >
        <option value="">{{ __($placeholder) }}</option>

        @foreach($options as $value => $labelOption)
            <option value="{{ $value }}">{{ $labelOption }}</option>
        @endforeach
    </select>

    @error($model)
        <span class="text-error text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>

{{-- fomrma de uso 1 --}}
{{-- <x-w4laravelkit.ui.select-component3 model="estado" :options="['ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO']"
    placeholder="ESTADO DE FLUJO DE TRABAJO" /> --}}

{{-- forma de uso 2 --}}
{{-- <x-w4laravelkit.ui.select-component3 model="modulo_asociado" :options="$modulosDisponibles" placeholder="MODULO ASOCIADO" /> --}}