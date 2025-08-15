<?php

namespace App\Livewire\W4LaravelKit\PowerGrid\RefreshTable;

use Carbon\Carbon;
use Livewire\Component;

class TableRefresherComponent extends Component
{
    /**
     * Lista de tablas con bandera de habilitado por tabla.
     * El 'name' DEBE coincidir con ->setName('...') de cada PowerGrid.
     */
    public array $tables = [
        ['name' => 'NOMBRE DE LA TABLA', 'enabled' => true],
    ];

    /** Polling global habilitado/deshabilitado */
    public bool $enabled = true;

    /** Intervalo de polling en milisegundos */
    public int $intervalMs = 5000;

    /** Ventana horaria (HH:mm, 24h) dentro de la cual SÍ refresca */
    public string $startTime = '09:00';
    public string $endTime   = '18:30';

    /**
     * Días de la semana permitidos (ISO 8601: 1 = Lunes ... 7 = Domingo)
     * Ej: L-V = [1,2,3,4,5]
     */
    public array $daysOfWeek = [1, 2, 3, 4, 5];

    /** Zona horaria para evaluar la ventana */
    public string $timezone = 'America/Monterrey';

    /**
     * Encender/apagar una tabla por nombre.
     */
    public function setTableEnabled(string $name, bool $enabled): void
    {
        foreach ($this->tables as &$t) {
            if ($t['name'] === $name) {
                $t['enabled'] = $enabled;
                break;
            }
        }
    }

    /**
     * Encender/apagar globalmente el refresco.
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Lógica principal de polling.
     * Respeta: enabled global, ventana horaria, días y enabled por tabla.
     */
    public function refreshTable(): void
    {
        if (!$this->enabled || !$this->withinSchedule()) {
            return;
        }

        foreach ($this->tables as $t) {
            if (!($t['enabled'] ?? false)) {
                continue;
            }
            // Livewire v3:
            $this->dispatch('pg:eventRefresh-' . $t['name']);
        }
    }

    /**
     * True si estamos dentro de la ventana y en día permitido.
     * Soporta ventanas que cruzan medianoche (p.ej. 22:00–02:00).
     */
    protected function withinSchedule(): bool
    {
        $now = Carbon::now($this->timezone);

        // Día permitido
        if (!in_array($now->dayOfWeekIso, $this->daysOfWeek, true)) {
            return false;
        }

        // Construye instantes start y end "hoy" en zona local
        [$sH, $sM] = array_map('intval', explode(':', $this->startTime));
        [$eH, $eM] = array_map('intval', explode(':', $this->endTime));

        $start = $now->copy()->setTime($sH, $sM, 0);
        $end   = $now->copy()->setTime($eH, $eM, 0);

        // Caso normal: start <= end (misma jornada)
        if ($start->lte($end)) {
            return $now->betweenIncluded($start, $end);
        }

        // Caso ventana trasnoche: end es del día siguiente (ej. 22:00–02:00)
        // En este caso, estamos "dentro" si es [now >= start] O [now <= end]
        return $now->gte($start) || $now->lte($end->copy()->addDay());
    }


    public function render()
    {
        return view('livewire.w4tlaravelkit.power-grid.refresh-table.table-refresher-component');
    }
}
