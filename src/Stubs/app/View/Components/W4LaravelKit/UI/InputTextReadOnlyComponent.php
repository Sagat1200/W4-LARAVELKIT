<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputTextReadOnlyComponent extends Component
{
    public $type;
    public $placeholder;
    public $model;
    public $value;
    public $class;

    /**
     * Crear nueva instacia del componente.
     */
    public function __construct($type, $placeholder, $model, $value, $class='')
    {
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->model = $model;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.inputtextreadonly-component');
    }
}