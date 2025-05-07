<?php

namespace App\Livewire\W4LaravelKit\UI;

use Livewire\Component;

class CheckboxToggleComponent extends Component
{

    public $checked = false;
    public $label = 'Remember me'; // Valor por defecto para el enunciado
    public $model; // Propiedad dinámica para `wire:model`

    public function mount($model = 'checked', $checked = false)
    {
        $this->model = $model;
        $this->checked = $checked;
    }

    public function updatedChecked($value)
    {
        // Manejar el cambio del checkbox si es necesario
    }

    public function render()
    {
        return view('livewire.w4tlaravelkit.ui.checkbox-toggle-component');
    }
}