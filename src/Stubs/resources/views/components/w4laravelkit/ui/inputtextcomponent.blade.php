<div class="mx-auto w-full max-w-xs input-group">
    <input oninput="this.value = this.value.toUpperCase()" type="{{ $type }}" placeholder="{{ $placeholder }}"
        wire:model.live="{{ $model }}"
        class="w-full max-w-xs uppercase input input-bordered input-sm input-primary {{ $class }}"{{ $status }}>
    @error($model)
        <div class="label">
            <span class="error">{{ $message }}</span>
        </div>
    @enderror
</div>
{{-- @include('components.w4laravelkit.ui.inputtextcomponent', [
  'type' => 'text',
  'placeholder' => 'Nombre',
  'model' => 'name',
  'class' => ''
]) --}}

{{-- <x-w4laravelkit.ui.inputtextcomponent 
    type="text" 
    placeholder="Nombre" 
    model="name" 
    class="" 
/> --}}
