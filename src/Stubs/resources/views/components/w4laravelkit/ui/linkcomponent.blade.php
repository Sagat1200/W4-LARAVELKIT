<div>
    <a href="{{ route($route) }}" class="link-hover {{ $class }}" wire:navigate
        @if ($tooltip) data-tooltip="{{ $tooltip }}" data-tooltip-position="{{ $tooltipPosition }}" @endif>
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
        bottom: 100%;
        /* Cambiar de inset-block-start a bottom para mayor compatibilidad */
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 0.5rem;
        /* Añadir margen para separarlo del elemento */
    }

    [data-tooltip-position="right"]::before {
        top: 50%;
        left: 100%;
        transform: translateY(-50%) translateX(0.5rem);
        z-index: 9999;
    }

    [data-tooltip-position="bottom"]::before {
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 0.5rem;
        /* Añadir margen para separarlo del elemento */
    }

    [data-tooltip-position="left"]::before {
        top: 50%;
        right: 100%;
        transform: translateY(-50%) translateX(-0.5rem);
    }
</style>
{{-- @include('components.w4laravelkit.ui.linkcomponent', [
      'route' => 'RUTA',
      'text' => 'TEXTO',
      'icon' => 'ICONO',
      'class' => 'btn btn-primary btn-sm mx-1',
      'tooltip' => '',
      'tooltipPosition' => '',
  ]) --}}

{{-- <x-w4laravelkit.ui.linkcomponent 
    route="RUTA" 
    text="TEXTO" 
    icon="ICONO" 
    class="btn btn-primary btn-sm mx-1" 
    tooltip="" 
    tooltip-position="" 
/> --}}
