<div class="mx-2 my-2 w-full max-w-xs input-group">
    <input type="text" wire:model.live="{{ $model }}" placeholder="{{ $placeholder }}"
        onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'"
        class="mx-2 my-2 w-full max-w-xs input input-bordered input-primary {{ $class }}">
    <div class="label">
        @error($model)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
{{-- @include('components.w4laravelkit.ui.inputdatecomponent', [
  'model' => 'fecha_nacimiento',
  'placeholder' => 'Fecha de nacimiento',
  'class' => '',
]) --}}

{{-- <x-w4laravelkit.ui.inputdatecomponent 
    model="fecha_nacimiento" 
    placeholder="Fecha de nacimiento" 
    class="" 
/> --}}
