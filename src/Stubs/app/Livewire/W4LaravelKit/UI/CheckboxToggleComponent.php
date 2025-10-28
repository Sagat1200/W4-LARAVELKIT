<?php

namespace App\Livewire\W4LaravelKit\UI;

use Livewire\Component;

class CheckboxToggleComponent extends Component
{

    #[Modelable]
    public bool $checked = false;

    public string $label = 'Remember me';

    public function mount(bool $checked = false, ?string $label = null): void
    {
        $this->checked = $checked;
        if ($label !== null) {
            $this->label = $label;
        }
    }

    public function render()
    {
        return view('livewire.w4laravelkit.ui.checkbox-toggle-component');
    }
}