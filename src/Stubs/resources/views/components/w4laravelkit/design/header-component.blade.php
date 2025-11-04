<div class="fixed z-50 w-full shadow-md bg-neutral text-neutral-content">
    <nav class="flex justify-between items-center py-1 lg:px-8">
        <!-- Logo y título -->
        <div class="flex items-center space-x-5 lg:ml-[-1rem] xl:ml-[-2rem]">
            <img src="{{ asset('assets/img/') }}" alt="Logo"
                class="ml-3 w-8 h-8 bg-white rounded-full sm:w-10 sm:h-10">
            <h3 class="hidden text-lg font-semibold sm:block">Nombre de la Aplicación</h3>
        </div>

        <!-- Opciones de usuario, tema, ajustes y logos -->
        <div class="flex items-center space-x-4">
            <!-- Usuario y opciones de logout -->
            <div class="relative dropdown dropdown-end">
                <button tabindex="0" class="flex items-center px-2 py-1 space-x-2 text-sm rounded-full btn btn-primary">
                    {{-- {{ auth()->guard('admin')->check() ? auth()->guard('admin')->user()->nombre : 'Invitado' }} --}}
                    <i class="text-xs fa-solid fa-chevron-down"></i>
                </button>
                <ul tabindex="0"
                    class="absolute right-0 z-20 p-2 mt-2 w-52 text-gray-500 shadow-lg dropdown-content menu bg-base-300 rounded-box">
                    <!--Lista de opciones de Usuario-->
                </ul>
            </div>
            <!-- Logo Secundario -->
            <img src="{{ asset('assets/img/') }}" alt="Logo"
                class="px-1 ml-1 w-8 h-8 bg-white rounded-full sm:w-10 sm:h-10">
        </div>
    </nav>
</div>
{{-- @include('components.w4laravelkit.design.header-component') --}}
{{-- <x-w4laravelkit.design.header-component/> --}}