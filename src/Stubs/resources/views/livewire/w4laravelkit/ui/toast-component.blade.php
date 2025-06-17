<div>
    @php
        // Determine the position classes for the container based on the first toast
        $containerPosition =
            count($toasts) > 0
                ? match ($toasts[0]['position']) {
                    'top-right' => 'top-5 right-5',
                    'top-left' => 'top-5 left-5',
                    'bottom-right' => 'bottom-5 right-5',
                    'bottom-left' => 'bottom-5 left-5',
                    default => 'top-5 right-5',
                }
                : 'top-5 right-5';
    @endphp

    <div class="fixed {{ $containerPosition }} space-y-2 z-[9999]">
        @foreach ($toasts as $index => $toast)
            @php
                $alertClasses = match ($toast['type']) {
                    'success' => 'alert alert-success',
                    'error' => 'alert alert-error',
                    'warning' => 'alert alert-warning',
                    'info' => 'alert alert-info',
                    default => 'alert alert-info',
                };
            @endphp
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => {
                show = false;
                Livewire.emit('removeToast', {{ $index }})
            }, {{ $toast['timeout'] }})"
                class="{{ $alertClasses }} rounded shadow p-4">
                @if ($toast['icon'])
                    <i class="{{ $toast['icon'] }}"></i>
                @endif
                <strong>{{ $toast['title'] }}</strong>
                <br>
                <p>{{ $toast['message'] }}</p>
                @if ($toast['progressBar'])
                    <div class="progress-bar" style="width: 100%; animation-duration: {{ $toast['timeout'] }}ms;"></div>
                @endif
            </div>
        @endforeach
    </div>
</div>

{{-- @livewire('w4laravelkit.ui.toast-component') --}}
{{-- <livewire:w4laravelkit.ui.toast-component /> --}}

{{-- $this->dispatch('showToast', [
                'type' => 'error',
                'title' => '',
                'message' => 'Error al eliminar el registro.',
                'timeout' => 5000,
                'icon' => 'fa-solid fa-exclamation-triangle',
                'position' => 'bottom-right',
                'progressBar' => true,
                'redirectTo' => null,
            ]); --}}