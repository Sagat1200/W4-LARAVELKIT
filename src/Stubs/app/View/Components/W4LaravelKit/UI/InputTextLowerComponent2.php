<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputTextLowerComponent2 extends Component
{
    public $type;

    public $placeholder;

    public $model;

    public $class;

    public $status;

    /**
     * Crear una nueva instancia del componente.
     * @param string $type Tipo del input (por ejemplo, 'text')
     * @param string $placeholder Placeholder del input
     * @param string $model Nombre del binding `wire:model`
     * @param string $class Clases CSS adicionales (opcional)
     * @param string $status Estado del input (por ejemplo, 'error', 'success', 'warning', 'info') (opcional)
     */
    public function __construct($type, $placeholder, $model, $class = '', $status = '')
    {
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->model = $model;
        $this->class = $class;
        $this->status = $status;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.inputtextlower-component2');
    }
}
