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
     * @param string $route
     * @param string $text
     * @param string $icon
     * @param string $class
     * @param string $tooltip
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
        return view('components.w4laravelkit.ui.linkcomponent');
    }
}