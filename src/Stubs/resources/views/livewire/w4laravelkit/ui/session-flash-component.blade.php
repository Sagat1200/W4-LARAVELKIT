<div>
    @if (session('alertType') && session('message'))
        @php
            // Clases de posición y progreso para la alerta
            $alertClasses = match (session('alertType')) {
                'alert-success' => 'alert alert-success',
                'alert-error' => 'alert alert-error',
                'alert-warning' => 'alert alert-warning',
                'alert-info' => 'alert alert-info',
                default => 'alert alert-info',
            };

            $positionClasses = match (session('position')) {
                'top-left' => 'top-5 left-5',
                'top-right' => 'top-5 right-5',
                'bottom-left' => 'bottom-5 left-5',
                'bottom-right' => 'bottom-5 right-5',
                default => 'top-5 right-5',
            };
        @endphp

        <div class="fixed {{ $positionClasses }} space-y-2 z-50">
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, {{ session('timeout', 3000) }})"
                class="{{ $alertClasses }} rounded shadow-lg p-4 flex flex-col space-y-2 items-start">

                <!-- Icono de alerta y mensaje -->
                <div class="flex items-center space-x-2">
                    @if (session('icon'))
                        <i class="{{ session('icon') }} text-lg"></i>
                    @endif
                    <span>{{ session('message') }}</span>
                </div>

                <!-- Barra de progreso -->
                @if (session('progressBar'))
                    <div class="overflow-hidden mt-2 w-full h-1.5 rounded-full bg-primary">
                        <div class="h-1.5 rounded-full bg-secondary"
                            style="width: 100%; animation: progressBar {{ session('timeout', 3000) / 1000 }}s linear;">
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <style>
            @keyframes progressBar {
                from {
                    width: 100%;
                }

                to {
                    width: 0;
                }
            }
        </style>
    @endif
</div>
{{-- @livewire('w4laravelkit.ui.session-flash-component') --}}
{{-- <livewire:w4laravelkit.ui.session-flash-component /> --}}