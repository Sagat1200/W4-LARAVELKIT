<?php

namespace App\Livewire\W4LaravelKit\UI;

use Livewire\Component;

class ToastComponent extends Component
{
    public $toasts = [];

    protected $listeners = ['showToast'];

    public function showToast($details)
    {
        $this->toasts[] = [
            'type' => $details['type'] ?? 'info',
            'title' => $details['title'] ?? '',
            'message' => $details['message'] ?? '',
            'timeout' => $details['timeout'] ?? 3000,
            'icon' => $details['icon'] ?? '',
            'position' => $details['position'] ?? '',
            'progressBar' => $details['progressBar'] ?? false,
        ];

        // Emitir evento de JavaScript para eliminar el toast después del timeout
        $this->dispatch('remove-toast', ['index' => count($this->toasts) - 1, 'timeout' => $details['timeout'] ?? 3000]);
    }

    public function removeToast($index)
    {
        unset($this->toasts[$index]);
        $this->toasts = array_values($this->toasts); // Reindex array
    }
    
    public function render()
    {
        return view('livewire.w4laravelkit.ui.toast-component');
    }
}