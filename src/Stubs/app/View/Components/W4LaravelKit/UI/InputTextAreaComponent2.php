<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputTextAreaComponent2 extends Component
{
    public $placeholder;

    public $model;

    public $type;

    public $class;

    /**
     * Crear nueva instancia de Componente
     * @param mixed $placeholder Placeholder del textarea
     * @param mixed $model Nombre del binding `wire:model`
     * @param mixed $type Tipo del textarea (por ejemplo, 'text')
     * @param mixed $class Clases CSS adicionales (opcional)
     */
    public function __construct($placeholder, $model, $type, $class = '')
    {
        $this->placeholder = $placeholder;
        $this->model = $model;
        $this->type = $type;
        $this->class = $class;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.inputtextarea-component2');
    }
}