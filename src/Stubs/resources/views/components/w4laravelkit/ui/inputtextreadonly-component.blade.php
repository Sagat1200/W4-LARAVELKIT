<div class="mx-auto w-full max-w-xs input-group">
    <input type="{{ $type }}" placeholder="{{ $placeholder }}"
        class="w-full max-w-xs uppercase input input-bordered input-sm input-primary {{ $class }}"
        wire:model="{{ $model }}" value="{{ $value }}" readonly>
    <div class="label">
        @error($model)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
{{-- @include('components.w4laravelkit.ui.inputtextreadonlycomponent', [
  'type' => 'text',
  'placeholder' => 'Nombre',
  'model' => 'name',
  'value' => 'Valor',
  'class' => '',
]) --}}

{{-- <x-w4laravelkit.ui.inputtextreadonlycomponent 
    type="text" 
    placeholder="Nombre" 
    model="name" 
    value="Valor" 
    class="" 
/> --}}
