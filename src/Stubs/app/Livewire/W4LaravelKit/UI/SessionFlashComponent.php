<?php

namespace App\Livewire\W4LaravelKit\UI;

use Livewire\Component;

class SessionFlashComponent extends Component
{
    public $alertType;
    public $message;
    public $timeout;
    public $icon;
    public $position;
    public $progressBar;

    public function mount()
    {
        $this->alertType = session('alertType', 'alert-info');
        $this->message = session('message', '');
        $this->timeout = session('timeout', 3000);
        $this->icon = session('icon', '');
        $this->position = session('position', 'top-right');
        $this->progressBar = session('progressBar', false);
    }
    
    public function render()
    {
        return view('livewire.w4laravelkit.ui.session-flash-component');
    }
}