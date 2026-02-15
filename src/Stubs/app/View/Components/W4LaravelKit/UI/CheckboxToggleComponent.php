<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class CheckboxToggleComponent extends Component
{
    public string $label;

    public bool $checked = false;

    public string $model;

    public string $type;

    public bool $disabled = false;

    public string $class;

    public string $value = '';

    public bool $indeterminate = false;

    /**
     * Crear nueva instancia del componente Checkbox/Toggle
     *
     * @param mixed $label Etiqueta del checkbox
     * @param mixed $checked Valor inicial (se convierte a boolean)
     * @param mixed $model Nombre del binding `wire:model` (opcional)
     * @param mixed $type Tipo del input (por defecto 'checkbox')
     * @param mixed $class Clases CSS adicionales
     * @param mixed $disabled Indicador deshabilitado (se convierte a boolean)
     * @param mixed $value Valor del input
     * @param mixed $indeterminate Indicador indeterminado (se convierte a boolean)
     */
    public function __construct($label, $checked = false, $model = '', $type = 'checkbox', $class = '', $disabled = false, $value = '', $indeterminate = false)
    {
        $this->label = $label;
        $this->checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
        $this->model = $model;
        $this->type = $type;
        $this->class = $class;
        $this->disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
        $this->value = is_string($value) ? $value : (string) $value;
        $this->indeterminate = filter_var($indeterminate, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.w4laravelkit.ui.checkbox-toggle-component');
    }
}
