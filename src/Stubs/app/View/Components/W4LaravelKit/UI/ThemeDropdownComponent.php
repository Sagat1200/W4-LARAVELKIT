<?php

namespace App\View\Components\W4LaravelKit\UI;

use Illuminate\View\Component;

class ThemeDropdownComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    {
        return view('components.w4laravelkit.themedropdowncomponent');
    }
}