@props([
    'model',
    'options' => [],
    'placeholder' => '',
    'label' => null,
    'selectClass' => '',
    'wireChange' => null, // Ejecuta un evento Livewire en la clase
])

<div class=" w-full max-w-xs input-group">
    @if ($label)
        <span class="block text-sm font-medium mb-1 text-base-content">{{ $label }}</span>
      @endif
    <select wire:model="{{ $model }}"
        @if ($wireChange) wire:change="{{ $wireChange }}" @endif
        class="select select-sm bg-base-100 text-base-content border border-primary focus:outline-none {{ $selectClass }}">
    <option value="">{{ __($placeholder) }}</option>
        @foreach ($options as $key => $text)
            <option value="{{ json_encode($key) }}">{{ $text }}</option>
        @endforeach
    </select>
    @error($model)
        <span class="text-error text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>
 
{{-- fomrma de uso 1 --}}
{{-- <x-w4laravelkit.ui.select-component2 model="estado" :options="['ACTIVO' => 'ACTIVO', 'INACTIVO' => 'INACTIVO']"
    placeholder="ESTADO DE FLUJO DE TRABAJO" /> --}}

{{-- forma de uso 2 --}}
{{-- <x-w4laravelkit.ui.select-component2 model="modulo_asociado" :options="$modulosDisponibles" placeholder="MODULO ASOCIADO" /> --}}