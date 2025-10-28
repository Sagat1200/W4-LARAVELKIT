@props([
    'themes' => [
        'abyss',
        'acid',
        'afkalmost',
        'aqua',
        'autumn',
        'black',
        'bumblebee',
        'business',
        'caramellatte',
        'coffee',
        'corporate',
        'cmyk',
        'cupcake',
        'cyberpunk',
        'dark',
        'dim',
        'dracula',
        'emerald',
        'fantasy',
        'forest',
        'garden',
        'goatedburn',
        'halloween',
        'irongoblin',
        'ironicflip',
        'lemonade',
        'light',
        'lofi',
        'luxury',
        'nextfox',
        'night',
        'nord',
        'pastel',
        'retro',
        'silk',
        'sunset',
        'Academik',
        'synthwave',
        'valentine',
        'wigglycake',
        'winter',
        'wireframe',
    ],
])

<style>
    .theme-selector-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .theme-btn-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
    }

    .theme-grid-item {
        transition: all 0.3s ease;
    }

    .theme-grid-item:hover {
        transform: translateY(-2px);
    }

    @keyframes pulse-theme {

        0%,
        100% {
            opacity: 0.8;
        }

        50% {
            opacity: 1;
        }
    }

    .pulse-theme {
        animation: pulse-theme 2s ease-in-out infinite;
    }

    /* Texto siempre en negro para mejor legibilidad */
    .adaptive-text {
        color: #000000 !important;
    }

    .adaptive-text-secondary {
        color: #4b5563 !important;
    }

    .adaptive-icon {
        color: #7c3aed !important;
    }

    .adaptive-icon-accent {
        color: #059669 !important;
    }

    .adaptive-border {
        border-color: rgba(0, 0, 0, 0.2);
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(59, 130, 246, 0.6);
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.8);
    }

    [x-cloak] { display: none !important; }
</style>

@persist('theme-dropdown')
    <div
        x-data="{ open: false, currentTheme: localStorage.getItem('theme') || (document.documentElement.dataset.theme || 'light') }"
        x-init="document.documentElement.setAttribute('data-theme', currentTheme)"
        @click.away="open = false"
        class="relative">
        <!-- Botón tecnológico para abrir el menú -->
        <button @click="open = !open"
            class="theme-selector-glass px-4 py-2 rounded-xl transition-all duration-300 theme-btn-hover pulse-theme group">
            <i class="fas fa-palette mr-2 adaptive-icon-accent"></i>
            <span class="hidden sm:inline font-semibold adaptive-text">Temas</span>
            <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300 adaptive-text"
                :class="open ? 'rotate-180' : ''"></i>
            <span class="sr-only">Abrir selector de temas</span>
        </button>
        <button
            aria-haspopup="menu"
            :aria-expanded="open.toString()"
            aria-controls="theme-menu"
            class="hidden"
        ></button>

        <!-- Menú desplegable tecnológico -->
        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95" class="absolute left-0 mt-3 z-50">

            <div
                class="theme-selector-glass p-4 rounded-2xl shadow-2xl w-[28rem] max-h-[16rem] overflow-hidden adaptive-container">
                <!-- Header del selector -->
                <div class="flex items-center justify-between mb-4 pb-3 border-b adaptive-border">
                    <h3 class="font-bold text-lg flex items-center adaptive-text">
                        <i class="fas fa-swatchbook mr-2 adaptive-icon"></i>
                        Selector de Temas
                    </h3>
                    <span class="text-sm adaptive-text-secondary">{{ count($themes) }} disponibles</span>
                </div>

                <!-- Grid de temas -->
                <div id="theme-menu" role="menu" class="grid grid-cols-3 gap-4 max-h-[10rem] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach ($themes as $theme)
                        <div class="theme-grid-item">
                            <label class="cursor-pointer group block">
                                <input
                                    type="radio"
                                    name="theme-dropdown"
                                    class="theme-controller sr-only"
                                    value="{{ $theme }}"
                                    x-model="currentTheme"
                                    :checked="currentTheme === '{{ $theme }}'"
                                    role="menuitemradio"
                                    :aria-checked="(currentTheme === '{{ $theme }}').toString()"
                                    aria-label="{{ ucfirst($theme) }}"
                                    @change="document.documentElement.setAttribute('data-theme', currentTheme); localStorage.setItem('theme', currentTheme); open = false;"
                                />
                                <div
                                    class="theme-selector-glass p-3 rounded-lg text-center border transition-all duration-300 group-hover:scale-105 min-h-[4rem] flex flex-col justify-center"
                                    :class="currentTheme === '{{ $theme }}' ? 'border-primary ring-1 ring-primary/40' : 'border-transparent hover:border-blue-400/50'"
                                >
                                    <!-- Indicador visual del tema -->
                                    <div
                                        class="w-6 h-6 mx-auto mb-1 rounded-full bg-gradient-to-br 
                                        @if ($theme === 'irongoblin') from-orange-400 to-orange-600 border border-orange-300
                                        @elseif($theme === 'afkalmost')
                                            from-green-400 to-green-600 border border-green-300
                                        @elseif($theme === 'wigglycake')
                                            from-purple-400 to-purple-600 border border-purple-300
                                        @elseif($theme === 'ironicflip')
                                            from-red-400 to-red-600 border border-red-300
                                        @elseif($theme === 'Academik')
                                            from-blue-400 to-blue-600 border border-blue-300
                                        @elseif($theme === 'goatedburn')
                                            from-purple-400 to-blue-600 border border-purple-300
                                        @elseif($theme === 'nextfox')
                                            from-orange-400 to-orange-600 border border-orange-300
                                        @elseif(in_array($theme, ['dark', 'night', 'business', 'black', 'dracula']))
                                            from-gray-700 to-gray-900 border border-gray-500
                                        @elseif(in_array($theme, ['cyberpunk', 'synthwave']))
                                            from-pink-400 to-purple-700 border border-pink-300
                                        @elseif(in_array($theme, ['forest', 'emerald', 'garden']))
                                            from-green-400 to-emerald-700 border border-green-300
                                        @elseif(in_array($theme, ['aqua', 'winter']))
                                            from-blue-300 to-cyan-600 border border-blue-200
                                        @elseif(in_array($theme, ['sunset', 'autumn']))
                                            from-orange-300 to-red-600 border border-orange-200
                                        @elseif(in_array($theme, ['light', 'cupcake', 'corporate', 'wireframe']))
                                            from-gray-200 to-gray-400 border border-gray-600
                                        @elseif(in_array($theme, ['retro', 'valentine']))
                                            from-rose-300 to-pink-600 border border-rose-200
                                        @elseif(in_array($theme, ['luxury', 'lofi']))
                                            from-amber-300 to-yellow-600 border border-amber-200
                                        @else
                                            from-blue-300 to-purple-600 border border-blue-200 @endif
                                        shadow-lg group-hover:shadow-xl">
                                    </div>
                                    <span
                                        class="adaptive-text text-xs font-medium transition-colors duration-300 leading-tight break-words">
                                        {{ ucfirst($theme) }}
                                    </span>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Footer con información -->
                <div class="mt-3 pt-3 border-t text-center adaptive-border">
                    <p class="text-xs flex items-center justify-center adaptive-text-secondary">
                        <i class="fas fa-info-circle mr-1 adaptive-icon"></i>
                        Selecciona un tema para cambiar la apariencia
                    </p>
                </div>
            </div>
        </div>
    </div>
@endpersist

{{-- @include('components.w4laravelkit.ui.themedropdowncomponent') --}}

{{-- <x-w4laravelkit.ui.themedropdowncomponent/> --}}