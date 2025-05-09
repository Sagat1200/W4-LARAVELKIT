@props([
    'options' => [],
    'model' => '',
    'placeholder' => 'Selecciona una opción',
])

<div x-data="{
    open: false,
    showAbove: false,
    selected: '', // manejado solo en Alpine
    options: @js($options),
    toggle() {
        this.calculatePosition();
        this.open = !this.open;
    },
    selectOption(option) {
        this.selected = option;
        this.open = false;

        // Aquí forzamos la actualización inmediata en Livewire
        $wire.set('{{ $model }}', option, true); // true = triggerChange
    },
    calculatePosition() {
        this.$nextTick(() => {
            const rect = this.$el.getBoundingClientRect();
            const spaceBelow = window.innerHeight - rect.bottom;
            this.showAbove = spaceBelow < 200;
        });
    }
}" class="relative w-full max-w-xs" x-init="$watch('selected', value => {
    if (value === '') {
        $wire.set('{{ $model }}', null)
    }
})">
    <!-- Botón desplegable -->
    <button type="button" @click="toggle"
        class="select select-sm w-full bg-base-100 text-base-content border border-primary focus:outline-none">
        <span x-text="selected || '{{ $placeholder }}'"></span>
    </button>

    <!-- Lista de opciones -->
    <ul x-show="open" x-transition @click.away="open = false"
        :class="[
            'absolute z-50 w-full max-h-60 overflow-y-auto bg-base-100 text-base-content text-sm border border-primary rounded-md shadow-lg',
            showAbove ? 'bottom-full mb-1' : 'top-full mt-1'
        ]"
        x-cloak>
        <template x-for="item in options" :key="item">
            <li @click="selectOption(item)" class="cursor-pointer px-4 py-1 hover:bg-base-300">
                <span x-text="item"></span>
            </li>
        </template>
    </ul>

    <!-- Mensaje de error -->
    @error($model)
        <span class="text-error text-xs mt-1 block">{{ $message }}</span>
    @enderror
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

{{-- @include('components.w4laravelkit.ui.select-component', [
    'wire:model' => 'tipo_domicilio',
    'model' => 'tipo_domicilio',
    'options' => [
        'PROPIO',
        'RENTADO',
    ],
    'placeholder' => 'TIPO DE DOMICILIO'
]) --}}

{{-- <x-w4laravelkit.ui.select-component wire:model="tipo_domicilio" model="tipo_domicilio" :options="[
    'PROPIO', 
    'RENTADO',
    ]"
    placeholder="TIPO DE DOMICILIO" /> --}}
