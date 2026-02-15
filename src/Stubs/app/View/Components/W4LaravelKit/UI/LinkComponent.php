<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class LinkComponent extends Component
{
    public string $route;
    public string $text;
    public string $icon;
    public string $class;
    public string $tooltip;

    /**
     * Crear una nueva instancia del componente.
     * @param string $route Ruta o URL a la que apunta el enlace
     * @param string $text Texto que se mostrará en el enlace
     * @param string $icon Nombre de la clase del icono (opcional)
     * @param string $class Clases CSS adicionales para el enlace (opcional)
     * @param string $tooltip Texto del tooltip que se mostrará al pasar el mouse (opcional)
     */
    public function __construct(string $route = '', string $text = '', string $icon = '', string $class = '', string $tooltip = '')
    {
        $this->route = $route;
        $this->text = $text;
        $this->icon = $icon;
        $this->class = $class;
        $this->tooltip = $tooltip;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.link-component');
    }
}