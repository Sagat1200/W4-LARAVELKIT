<textarea placeholder="{{ $placeholder }}" class="textarea textarea-primary textarea-bordered textarea-xs {{ $class }}"
    wire:model="{{ $model }}"></textarea>
<div class="label">
    @error($model)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
{{-- @include('components.w4laravelkit.ui.inputtextarea-component', [
'type' => 'text',
'placeholder' => 'Nombre',
'model' => 'name',
'class' => '',
]) --}}

{{-- <x-w4laravelkit.ui.inputtextarea-component type="text" placeholder="Nombre" model="name" class="" /> --}}
