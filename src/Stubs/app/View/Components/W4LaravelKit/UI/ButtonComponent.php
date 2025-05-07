<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;
use Illuminate\View\View;

class ButtonComponent extends Component
{
    public $icon;
    public $class;
    public $label;
    public $type;
    public $tooltip;
    public $badge;
    public $confirm;
    public $wire_click;

    /**
     * Crear una nueva instancia del componente.
     *
     * @param string $icon
     * @param string $class
     * @param string $label
     * @param string $type
     * @param string $tooltip
     * @param string $badge
     * @param string|null $confirm
     * @param string|null $wire_click
     */
    public function __construct($icon = '', $class = '', $label = '', $type = 'button', $tooltip = '', $badge = '', $confirm = null, $wire_click = null)
    {
        $this->icon = $icon;
        $this->class = $class;
        $this->label = $label;
        $this->type = $type;
        $this->tooltip = $tooltip;
        $this->badge = $badge;
        $this->confirm = $confirm;
        $this->wire_click = $wire_click;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.w4laravelkit.ui.buttoncomponent');
    }
}