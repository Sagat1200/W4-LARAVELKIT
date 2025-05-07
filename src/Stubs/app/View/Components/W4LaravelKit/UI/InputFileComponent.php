<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class InputFileComponent extends Component
{
    public $type;
    public $label;
    public $model;
    /**
     * Crear nueva instacia del componente.
     */
    public function __construct($type, $label, $model)
    {
        $this->type = $type;
        $this->label = $label;
        $this->model = $model;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.inputfilecomponent');
    }
}