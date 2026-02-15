<div>
    <a href="{{ route($route) }}" class="link-hover {{ $class }}" wire:navigate @if ($tooltip)
    data-tooltip="{{ $tooltip }}" data-tooltip-position="{{ $tooltipPosition }}" @endif>
        @if ($icon)
            <!-- Mostrar el icono si está presente -->
            <i class="{{ $icon }}" aria-hidden="true"></i>
        @endif
        {{ $text }}
    </a>
</div>

<style>
    [data-tooltip] {
        position: relative;
    }

    [data-tooltip]::before {
        content: attr(data-tooltip);
        position: absolute;
        background-color: oklch(var(--p));
        color: oklch(var(--pc));
        padding: 0.5rem;
        border-radius: 0.25rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        z-index: 10000;
        /* Añadir un z-index alto para que el tooltip aparezca por encima */
    }

    [data-tooltip]:hover::before {
        opacity: 1;
    }

    [data-tooltip-position="top"]::before {
        inset-block-end: 100%;
        /* Cambiar de inset-block-start a bottom para mayor compatibilidad */
        inset-inline-start: 50%;
        transform: translateX(-50%);
        marmargin-block-end: 0.5rem;
        /* Añadir margen para separarlo del elemento */
    }

    [data-tooltip-position="right"]::before {
        inset-block-start: 50%;
        inset-inline-start: 100%;
        transform: translateY(-50%) translateX(0.5rem);
        z-index: 9999;
    }

    [data-tooltip-position="bottom"]::before {
        inset-block-start: 100%;
        inset-inline-start: 50%;
        transform: translateX(-50%);
        margin-block-end: 0.5rem;
        /* Añadir margen para separarlo del elemento */
    }

    [data-tooltip-position="left"]::before {
        inset-block-start: 50%;
        inset-inline-end: 100%;
        transform: translateY(-50%) translateX(-0.5rem);
    }
</style>
{{-- @include('components.w4laravelkit.ui.link-component', [
'route' => 'RUTA',
'text' => 'TEXTO',
'icon' => 'ICONO',
'class' => 'btn btn-primary btn-sm mx-1',
'tooltip' => '',
'tooltipPosition' => '',
]) --}}

{{-- <x-w4laravelkit.ui.link-component route="RUTA" text="TEXTO" icon="ICONO" class="btn btn-primary btn-sm mx-1"
    tooltip="" tooltip-position="" /> --}}