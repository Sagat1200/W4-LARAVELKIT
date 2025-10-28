<div>
    @if ($registros->hasPages())
        <div class="flex flex-col justify-between items-center my-4 space-y-2 sm:flex-row sm:space-y-0">
            <div class="flex justify-center btn-group">
                {{-- Botón de Página Anterior --}}
                @if ($registros->onFirstPage())
                    <span class="px-4 btn btn-outline btn-disabled">«</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                        class="px-4 btn btn-outline">«</button>
                @endif

                {{-- Indicador de Página Actual --}}
                <span class="px-4 mx-2 btn btn-primary">
                    Página {{ $registros->currentPage() }} de {{ $registros->lastPage() }}
                </span>

                {{-- Botón de Página Siguiente --}}
                @if ($registros->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                        class="px-4 btn btn-outline">»</button>
                @else
                    <span class="px-4 btn btn-outline btn-disabled">»</span>
                @endif
            </div>

            <div class="mt-2 text-sm font-semibold text-center sm:text-right sm:mt-0">
                Mostrando {{ $registros->firstItem() }} a {{ $registros->lastItem() }} de
                {{ $registros->total() }} registros
            </div>
        </div>
    @endif
</div>

{{-- @include('components.w4laravelkit.ui.paginatorcomponent', [
    'registros' => $registros,
    'query' => $query,
]) --}}

{{-- <x-w4laravelkit.ui.paginatorcomponent 
    :registros="$registros" 
    :query="$query" 
/> --}}
