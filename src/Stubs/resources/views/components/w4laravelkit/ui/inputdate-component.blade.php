@props([
    'type' => 'date',
    'placeholder' => '',
    'model',
    'class' => '',
    'status' => '',
    'autofocus' => false,
])

@php
    $eventoLimpieza = 'limpiar-' . str_replace(['.', '[', ']'], ['-', '-', ''], $model);
@endphp

<div class="w-full max-w-xs input-group">
    <input x-data="{
        clearInput() {
            this.$refs.input.value = '';
            this.$dispatch('input', '');
            if (this.$wire) {
                this.$wire.set('{{ $model }}', '');
            }
        }
    }" x-ref="input" x-on:{{ $eventoLimpieza }}.window="clearInput()"
        oninput="this.value = this.value.toUpperCase()" type="{{ $type }}" placeholder="{{ $placeholder }}"
        wire:model="{{ $model }}"
        class="w-full max-w-xs uppercase input input-bordered input-sm input-primary {{ $class }}"
        {{ $status }} @if ($autofocus) autofocus @endif>

    @error($model)
        <div class="label">
            <span class="text-error text-sm mt-1 block">{{ $message }}</span>
        </div>
    @enderror
</div>

{{-- @include('components.w4laravelkit.ui.inputdatecomponent', [
  'type' => 'text',
  'placeholder' => 'Nombre',
  'model' => 'name',
  'class' => '',
  'status' => '',
]) --}}

{{-- <x-w4laravelkit.ui.inputdatecomponent 
    type="text" 
    placeholder="Nombre" 
    model="name" 
    class="" 
/> --}}
