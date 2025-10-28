<button type="{{ $type }}" class="btn btn-{{ $class }}"
    @if ($tooltip) data-tooltip="{{ $tooltip }}" data-tooltip-position="{{ $tooltipPosition }}" @endif>
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
    @if ($label)
        <span>{{ $label }}</span>
    @endif
    @if ($badge)
        <span class="px-2 py-1 text-xs text-white bg-gray-500 rounded-full badge">{{ $badge }}</span>
    @endif
</button>

<style>
    [data-tooltip] {
        position: relative;
    }

    [data-tooltip]::before {
        content: attr(data-tooltip);
        position: absolute;
        background-color: rgba(0, 0, 0, 0.75);
        color: #fff;
        padding: 0.5rem;
        border-radius: 0.25rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
    }

    [data-tooltip]:hover::before {
        opacity: 1;
    }

    [data-tooltip-position="top"]::before {
        inset-block-start: -2.5rem;
        inset-inline-start: 50%;
        transform: translateX(-50%);
    }

    [data-tooltip-position="right"]::before {
        inset-block-start: 50%;
        inset-inline-start: 100%;
        transform: translateY(-50%) translateX(0.5rem);
    }

    [data-tooltip-position="bottom"]::before {
        inset-block-end: -2.5rem;
        inset-inline-start: 50%;
        transform: translateX(-50%);
    }

    [data-tooltip-position="left"]::before {
        inset-block-start: 50%;
        inset-inline-end: 100%;
        transform: translateY(-50%) translateX(-0.5rem);
    }
</style>
{{-- @include('components.w4laravelkit.ui.buttoncomponent', ['type' => '', 'class' => '',
    'tooltip' => '', 'icon' => '', 'tooltipPosition' => '', 'label' => '', 'badge' => '']) --}}

{{-- <x-w4laravelkit.ui.buttoncomponent 
    type=""
    class=""
    tooltip=""
    icon=""
    tooltip-position=""
    label=""
    badge=""
    /> --}}
