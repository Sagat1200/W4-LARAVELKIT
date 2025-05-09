@props([
    'themes' => [
        'light', 'night', 'cupcake', 'bumblebee', 'dark', 'lofi', 'emerald', 'corporate', 'synthwave', 'retro', 'cyberpunk', 'valentine',
        'halloween', 'garden', 'forest', 'aqua', 'pastel', 'fantasy', 'wireframe', 'black', 'luxury', 'dracula', 'cmyk', 'autumn',
        'business', 'acid', 'lemonade', 'coffee', 'dim', 'nord', 'sunset', 'caramellatte', 'abyss', 'silk', 'winter',
        'irongoblin', 'afkalmost', 'wigglycake', 'ironicflip', 'superschool', 'goatedburn', 'nextfox'
    ]
])

@persist('theme-dropdown')
<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <!-- Botón para abrir el menú -->
    <button @click="open = !open" class="btn btn-outline btn-primary btn-sm mx-1 my-2">
        <i class="fa-solid fa-palette"></i>
    </button>

    <!-- Menú desplegable -->
    <ul x-show="open" x-transition
        class="grid grid-cols-7 gap-2 p-2 mt-1 w-[28rem] h-[24rem] overflow-y-auto text-gray-500 shadow-lg absolute z-20 bg-base-300 rounded-box"
        style="top: 100%;">
        @foreach ($themes as $theme)
            <li>
                <input type="radio" name="theme-dropdown" class="theme-controller btn btn-sm btn-block btn-ghost"
                    aria-label="{{ ucfirst($theme) }}" value="{{ $theme }}" />
            </li>
        @endforeach
    </ul>
</div>
@endpersist

{{-- @include('components.w4laravelkit.ui.themedropdowncomponent') --}}

{{-- <x-w4laravelkit.ui.themedropdowncomponent/> --}}