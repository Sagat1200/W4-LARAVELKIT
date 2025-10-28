<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class PaginatorComponent extends Component
{
    public $registros;
    /**
     * Crear una nueva instancia del componente.
     * @param $registros
     */
    public function __construct($registros)
    {
        $this->registros = $registros;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.paginator-component');
    }
}