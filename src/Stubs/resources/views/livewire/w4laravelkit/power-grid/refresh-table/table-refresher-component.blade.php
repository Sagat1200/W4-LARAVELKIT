<div>
    {{-- Poller "silencioso": dispara refreshTable() cada N ms --}}
    <div wire:poll.{{ $intervalMs }}ms="refreshTable" class="hidden" aria-hidden="true"></div>
</div>


<!-- INSERTAR EN LOS LAYOUTS A UTILIZAR -->
{{-- Puedes sobreescribir cualquier propiedad de configuración --}}
    <!-- <livewire:power-grid.modules.refresh.table.table-refresher :tables="[
        ['name' => 'CRM Clientes', 'enabled' => true],
    ]" :intervalMs="60000" enabled="true"
        startTime="09:00" endTime="19:00" timezone="America/Mexico_City" :daysOfWeek="[1, 2, 3, 4, 5, 6]" /> -->