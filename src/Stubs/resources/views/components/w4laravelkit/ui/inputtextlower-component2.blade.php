@props([
    'type'        => 'text',
    'placeholder' => '',
    'model', // e.g. "fields.nombre"
    'class'       => '',
    'defer'       => true,
])

@php
    // El error key coincide con el binding
    $errorKey = $model;
@endphp

<div class="w-full max-w-xs input-group">
    <input
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        @if($defer)
            wire:model="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif
        class="w-full max-w-xs input input-bordered input-sm input-primary {{ $class }} @error($errorKey) input-error @enderror"
    />

    @error($errorKey)
        <div class="label">
            <span class="text-error text-sm mt-1 block">{{ $message }}</span>
        </div>
    @enderror
</div>

{{-- @include('components.w4laravelkit.ui.inputtextlower-component2', [
    'type' => 'text',
    'placeholder' => 'Nombre',
    'model' => 'name',
    'class' => '',
]) --}}

{{-- <x-w4laravelkit.ui.inputtextlower-component2 
    type="text" 
    placeholder="Nombre" 
    model="name" 
    class="" 
/> --}}