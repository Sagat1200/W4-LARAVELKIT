<label class="mx-2 my-2 w-full max-w-xs form-control">
    <div class="label">
        <span class="label-text">{{ $label }}</span>
    </div>
    <input type="file" wire:model="{{ $model }}"
        class="w-full max-w-xs file-input file-input-bordered file-input-primary" />
    <div class="label">
        @error($model)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</label>
{{-- @include('components.w4laravelkit.ui.inputfilecomponent', [
  'model' => 'file',
  'label' => 'Archivo',
]) --}}

{{-- <x-w4laravelkit.ui.inputfilecomponent 
    model="file" 
    label="Archivo" 
/> --}}
