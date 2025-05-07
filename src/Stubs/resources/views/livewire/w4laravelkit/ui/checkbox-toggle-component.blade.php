<div class="form-control">
    <label class="cursor-pointer label">
        <span class="label-text">{{ $label }}</span>
        <input type="checkbox" wire:model="{{ $model }}" class="checkbox checkbox-primary" />
    </label>
</div>
{{-- @livewire('w4laravelkit.ui.checkbox-toggle-component', [
    'model' => 'disponibilidad_llave',
    'checked' => true,
    'label' => 'Llave Disponible'
]) --}}
{{-- <livewire:w4laravelkit.ui.checkbox-toggle-component model="disponibilidad_llave" checked="true" label="Llave Disponible" /> --}}