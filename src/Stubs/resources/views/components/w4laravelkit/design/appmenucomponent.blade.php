@php
    $primary = [
        <!-- ['route' => 'user.dashboard', 'text' => 'Panel de Inicio', 'icon' => 'fa-solid fa-house'],
        ['route' => 'info', 'text' => 'Información', 'icon' => 'fa-solid fa-circle-info'],
        ['route' => 'crm', 'text' => 'CRM', 'icon' => 'fa-solid fa-handshake'],
        ['route' => 'kyc', 'text' => 'KYC Cliente', 'icon' => 'fa-solid fa-id-card'],
        ['route' => 'controldesck', 'text' => 'Mesa de Control', 'icon' => 'fa-solid fa-tachograph-digital'],
        ['route' => 'servidesck', 'text' => 'Mesa de Soporte', 'icon' => 'fa-solid fa-headset'],
        ['route' => 'automatizacion', 'text' => 'Automatización', 'icon' => 'fa-solid fa-robot'],
        ['route' => 'contabilidad', 'text' => 'Contabilidad', 'icon' => 'fa-solid fa-calculator'],
        ['route' => 'documentos', 'text' => 'Documentos', 'icon' => 'fa-solid fa-file-lines'],
        ['route' => 'ai', 'text' => 'NucleBank-AI', 'icon' => 'fa-solid fa-brain'],
        ['route' => 'pld', 'text' => 'PLD', 'icon' => 'fa-solid fa-shield-halved'], -->
    ];
    $secondary = [
        <!-- ['route' => 'blockchain', 'text' => 'Blockchain', 'icon' => 'fa-brands fa-bitcoin'],
        ['route' => 'conectividad', 'text' => 'Conectividad', 'icon' => 'fa-solid fa-network-wired'],
        ['route' => 'web', 'text' => 'WEB', 'icon' => 'fa-solid fa-globe'], -->
    ];
    <!-- $settings = [['route' => 'configuracion', 'text' => 'Configuración', 'icon' => 'fa-solid fa-gears']]; -->

    // Tono activo configurable: 'primary', 'secondary' o 'accent'
    $activeTone = $activeTone ?? 'accent';

    $toneActive = [
        'primary' => 'bg-primary/15 text-primary ring-1 ring-primary/30 border-primary',
        'secondary' => 'bg-secondary/15 text-secondary ring-1 ring-secondary/30 border-secondary',
        'accent' => 'bg-accent/15 text-accent ring-1 ring-accent/30 border-accent',
    ];

    $toneHover = [
        'primary' => 'hover:border-primary/40',
        'secondary' => 'hover:border-secondary/40',
        'accent' => 'hover:border-accent/40',
    ];

    $baseItem = 'w-full flex items-center gap-3 px-3 py-2 rounded-lg transition-colors border-l-2';
@endphp

<nav class="px-2">
    <div class="text-xs font-semibold tracking-wide opacity-60 px-2 mt-1">APLICACIONES</div>
    <ul class="mt-2 space-y-1">
        @foreach ($primary as $it)
            @php $active = request()->routeIs($it['route'].'*'); @endphp
            <li>
                @include('components.w4laravelkit.ui.linkcomponent', [
                    'route' => $it['route'],
                    'text' => $it['text'],
                    'icon' => $it['icon'],
                    'class' => $active
                        ? '' . $baseItem . ' ' . $toneActive[$activeTone]
                        : '' . $baseItem . ' border-transparent hover:bg-base-200 ' . $toneHover[$activeTone],
                    'tooltip' => '',
                    'tooltipPosition' => '',
                ])
            </li>
        @endforeach
    </ul>

    <div class="divider my-3"></div>

    <ul class="space-y-1">
        @foreach ($secondary as $it)
            @php $active = request()->routeIs($it['route'].'*'); @endphp
            <li>
                @include('components.w4laravelkit.ui.linkcomponent', [
                    'route' => $it['route'],
                    'text' => $it['text'],
                    'icon' => $it['icon'],
                    'class' => $active
                        ? '' . $baseItem . ' ' . $toneActive[$activeTone]
                        : '' . $baseItem . ' border-transparent hover:bg-base-200 ' . $toneHover[$activeTone],
                    'tooltip' => '',
                    'tooltipPosition' => '',
                ])
            </li>
        @endforeach
    </ul>

    <div class="divider my-3"></div>

    <ul class="space-y-1">
        @foreach ($settings as $it)
            @php $active = request()->routeIs($it['route'].'*'); @endphp
            <li>
                @include('components.w4laravelkit.ui.linkcomponent', [
                    'route' => $it['route'],
                    'text' => $it['text'],
                    'icon' => $it['icon'],
                    'class' => $active
                        ? '' . $baseItem . ' ' . $toneActive[$activeTone]
                        : '' . $baseItem . ' border-transparent hover:bg-base-200 ' . $toneHover[$activeTone],
                    'tooltip' => '',
                    'tooltipPosition' => '',
                ])
            </li>
        @endforeach
    </ul>
</nav>
{{-- @include('components.w4laravelkit.design.appmenucomponent') --}}
{{-- <x-w4laravelkit.design.appmenucomponent/> --}}