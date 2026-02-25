<?php

namespace W4LaravelKit\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use W4Laravelkit\Commands\InstallW4LaravelKit;
use App\Livewire\W4LaravelKit\PowerGrid\Fonts\PowerGridFont1;
use App\Livewire\W4LaravelKit\PowerGrid\RefreshTable\TableRefresherComponent;
use App\Livewire\W4LaravelKit\UI\SessionFlashComponent;
use App\Livewire\W4LaravelKit\UI\ToastComponent;
use App\View\Components\W4LaravelKit\Design\HeaderComponent;
use App\View\Components\W4LaravelKit\Design\AppMenuComponent;
use App\View\Components\W4LaravelKit\Design\TableNameComponent;
use App\View\Components\W4LaravelKit\Design\CenterHeroComponent;
use App\View\Components\W4LaravelKit\UI\ButtonComponent;
use App\View\Components\W4LaravelKit\UI\CheckboxToggleComponent;
use App\View\Components\W4LaravelKit\UI\InputDateComponent;
use App\View\Components\W4LaravelKit\UI\InputDateTimeComponent;
use App\View\Components\W4LaravelKit\UI\InputFileComponent;
use App\View\Components\W4LaravelKit\UI\InputTextAreaComponent;
use App\View\Components\W4LaravelKit\UI\InputTextAreaComponent2;
use App\View\Components\W4LaravelKit\UI\InputTextComponent;
use App\View\Components\W4LaravelKit\UI\InputTextComponent2;
use App\View\Components\W4LaravelKit\UI\InputTextLowerComponent;
use App\View\Components\W4LaravelKit\UI\InputTextLowerComponent2;
use App\View\Components\W4LaravelKit\UI\InputTextReadOnlyComponent;
use App\View\Components\W4LaravelKit\UI\InputTimeComponent;
use App\View\Components\W4LaravelKit\UI\LinkComponent;
use App\View\Components\W4LaravelKit\UI\PaginatorComponent;
use App\View\Components\W4LaravelKit\UI\SelectComponent;
use App\View\Components\W4LaravelKit\UI\SelectComponent2;
use App\View\Components\W4LaravelKit\UI\SelectComponent3;
use App\View\Components\W4LaravelKit\UI\ThemeDropdownComponent;

class W4LaravelKitServiceProvider extends ServiceProvider
{
    /**
     * Inicia los servicios del paquete.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallW4LaravelKit::class,
            ]);

            // 📌 Publicar Clases y Vistas de componentes en el Proyecto Laravel
            $this->publishes([

                //DESIGN

                // 📌 AppMenu Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/AppMenuComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/AppMenuComponent.php'),

                // 📌 Appmenu Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/appmenu-component.blade.php'
                => resource_path('views/components/w4laravelkit/design/appmenu-component.blade.php'),

                // 📌 Center Hero Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/CenterHeroComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/CenterHeroComponent.php'),

                // 📌 Center Hero Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/centerhero-component.blade.php'
                => resource_path('views/components/w4laravelkit/design/centerhero-component.blade.php'),

                // 📌 Header Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/HeaderComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/HeaderComponent.php'),

                // 📌 Header Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/header-component.blade.php'
                => resource_path('views/components/w4laravelkit/design/header-component.blade.php'),

                // 📌 TableName Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/TableNameComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/TableNameComponent.php'),

                // 📌 Table Name Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/tablename-component.blade.php'
                => resource_path('views/components/w4laravelkit/design/tablename-component.blade.php'),


                // UI

                // 📌 Button Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/ButtonComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/ButtonComponent.php'),

                // 📌 Blade Button Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/button-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/button-component.blade.php'),

                 // 📌 CheckboxToggle Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/CheckboxToggleComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/CheckboxToggleComponent.php'),

                // 📌 Blade CheckboxToggle Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/checkbox-toggle-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/checkbox-toggle-component.blade.php'),

                // 📌 InputDate Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputDateComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputDateComponent.php'),

                // 📌 Blade InputDate Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputdate-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputdate-component.blade.php'),

                // 📌 InputDateTime Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputDateTimeComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputDateTimeComponent.php'),

                // 📌 Blade InputDateTime Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputdatetime-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputdatetime-component.blade.php'),


                // 📌 InputTime Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTimeComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTimeComponent.php'),

                // 📌 Blade InputTime Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtime-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtime-component.blade.php'),

                // 📌 InputFile Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputFileComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputFileComponent.php'),

                // 📌 Blade InputFile Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputfile-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputfile-component.blade.php'),

                // 📌 InputTextArea Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextAreaComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextAreaComponent.php'),

                // 📌 Blade InputTextArea Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextarea-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextarea-component.blade.php'),

                 // 📌 InputTextArea Component2
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextAreaComponent2.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextAreaComponent2.php'),

                // 📌 Blade InputTextArea Component2 Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextarea-component2.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextarea-component2.blade.php'),

                // 📌 InputText Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextComponent.php'),

                // 📌 Blade InputText Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtext-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtext-component.blade.php'),

                // 📌 InputText Component2
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextComponent2.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextComponent2.php'),

                // 📌 Blade InputText Component2 Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtext-component2.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtext-component2.blade.php'),

                // 📌 InputTextLower Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextLowerComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextLowerComponent.php'),

                // 📌 Blade InputTextLower Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextlower-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextlower-component.blade.php'),

                 // 📌 InputTextLower Component2
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextLowerComponent2.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextLowerComponent2.php'),

                // 📌 Blade InputTextLower Component2 Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextlower-component2.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextlower-component2.blade.php'),

                // 📌 InputTextReadOnly Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextReadOnlyComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextReadOnlyComponent.php'),

                // 📌 Blade InputTextReadOnly Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextreadonly-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextreadonly-component.blade.php'),

                // 📌 Link Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/LinkComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/LinkComponent.php'),

                // 📌 Blade Link Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/link-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/link-component.blade.php'),

                // 📌 Paginator Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/PaginatorComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/PaginatorComponent.php'),

                // 📌 Blade Paginator Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/paginator-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/paginator-component.blade.php'),

                // 📌 Select Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/SelectComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/SelectComponent.php'),

                // 📌 Blade Select Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/select-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/select-component.blade.php'),

                // 📌 Select Component2
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/SelectComponent2.php'
                => app_path('View/Components/W4LaravelKit/UI/SelectComponent2.php'),

                // 📌 Blade Select Component2 Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/select-component2.blade.php'
                => resource_path('views/components/w4laravelkit/ui/select-component2.blade.php'),

                // 📌 Select Component3
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/SelectComponent3.php'
                => app_path('View/Components/W4LaravelKit/UI/SelectComponent3.php'),

                // 📌 Blade Select Component3 Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/select-component3.blade.php'
                => resource_path('views/components/w4laravelkit/ui/select-component3.blade.php'),

                // 📌 ThemeDropdown Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/ThemeDropdownComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/ThemeDropdownComponent.php'),

                // 📌 Blade ThemeDropdown Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/themedropdown-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/themedropdown-component.blade.php'),


                //📌 Livewire Components

                //  PowerGrid 

                // 📌 Livewire PowerGridFont1 Class
                __DIR__ . '/../Stubs/app/Livewire/W4LaravelKit/PowerGrid/Fonts/PowerGridFont1.php'
                => app_path('Livewire/W4LaravelKit/PowerGrid/Fonts/PowerGridFont1.php'),

                // 📌 Livewire RefreshTable Component
                __DIR__ . '/../Stubs/app/Livewire/W4LaravelKit/PowerGrid/RefreshTable/TableRefresherComponent.php'
                => app_path('Livewire/W4LaravelKit/PowerGrid/RefreshTable/TableRefresherComponent.php'),

                // 📌 Livewire table-refresher-component Views
                __DIR__ . '/../Stubs/resources/views/livewire/w4laravelkit/power-grid/refresh-table/table-refresher-component.blade.php'
                => resource_path('views/livewire/w4laravelkit/power-grid/refresh-table/table-refresher-component.blade.php'),

                // UI

                // 📌 Livewire Toast Component
                __DIR__ . '/../Stubs/app/Livewire/W4LaravelKit/UI/ToastComponent.php'
                => app_path('Livewire/W4LaravelKit/UI/ToastComponent.php'),

                // 📌 Livewire ToastComponent Views
                __DIR__ . '/../Stubs/resources/views/livewire/w4laravelkit/ui/toast-component.blade.php'
                => resource_path('views/livewire/w4laravelkit/ui/toast-component.blade.php'),

                // 📌 Livewire Session Flash Component
                __DIR__ . '/../Stubs/app/Livewire/W4LaravelKit/UI/SessionFlashComponent.php'
                => app_path('Livewire/W4LaravelKit/UI/SessionFlashComponent.php'),

                // 📌 Livewire SessionFlashComponent Views
                __DIR__ . '/../Stubs/resources/views/livewire/w4laravelkit/ui/session-flash-component.blade.php'
                => resource_path('views/livewire/w4laravelkit/ui/session-flash-component.blade.php'),

            ], 'w4laravelkit-components');
        }

        // ✅ Registrar Componentes de Diseño Blade solo si existen
        if (class_exists(AppMenuComponent::class)) {
            Blade::component('w4laravelkit-appmenu', AppMenuComponent::class);
        }

        if (class_exists(CenterHeroComponent::class)) {
            Blade::component('w4laravelkit-centerhero', CenterHeroComponent::class);
        }

        if (class_exists(HeaderComponent::class)) {
            Blade::component('w4laravelkit-header', HeaderComponent::class);
        }

        if (class_exists(TableNameComponent::class)) {
            Blade::component('w4laravelkit-tablename', TableNameComponent::class);
        }

        // ✅ Registrar Componentes de Ui Blade solo si existen

        if (class_exists(ButtonComponent::class)) {
            Blade::component('w4laravelkit-button', ButtonComponent::class);
        }

        if (class_exists(CheckboxToggleComponent::class)) {
            Blade::component('w4laravelkit-checkbox-toggle', CheckboxToggleComponent::class);
        }

        if (class_exists(InputDateComponent::class)) {
            Blade::component('w4laravelkit-inputDate', InputDateComponent::class);
        }

        if (class_exists(InputDateTimeComponent::class)) {
            Blade::component('w4laravelkit-inputDateTime', InputDateTimeComponent::class);
        }

        if (class_exists(InputTimeComponent::class)) {
            Blade::component('w4laravelkit-inputTime', InputTimeComponent::class);
        }

        if (class_exists(InputFileComponent::class)) {
            Blade::component('w4laravelkit-inputFile', InputFileComponent::class);
        }

        if (class_exists(InputTextAreaComponent::class)) {
            Blade::component('w4laravelkit-inputTextArea', InputTextAreaComponent::class);
        }

        if (class_exists(InputTextAreaComponent2::class)) {
            Blade::component('w4laravelkit-inputTextArea2', InputTextAreaComponent2::class);
        }

        if (class_exists(InputTextComponent::class)) {
            Blade::component('w4laravelkit-inputText', InputTextComponent::class);
        }

        if (class_exists(InputTextComponent2::class)) {
            Blade::component('w4laravelkit-inputText2', InputTextComponent2::class);
        }

        if (class_exists(InputTextLowerComponent::class)) {
            Blade::component('w4laravelkit-inputTextLower', InputTextLowerComponent::class);
        }

        if (class_exists(InputTextLowerComponent2::class)) {
            Blade::component('w4laravelkit-inputTextLower2', InputTextLowerComponent2::class);
        }

        if (class_exists(InputTextReadOnlyComponent::class)) {
            Blade::component('w4laravelkit-inputTextReadOnly', InputTextReadOnlyComponent::class);
        }

        if (class_exists(LinkComponent::class)) {
            Blade::component('w4laravelkit-link', LinkComponent::class);
        }

        if (class_exists(PaginatorComponent::class)) {
            Blade::component('w4laravelkit-paginator', PaginatorComponent::class);
        }

        if (class_exists(SelectComponent::class)) {
            Blade::component('w4laravelkit-select', SelectComponent::class);
        }

        if (class_exists(SelectComponent2::class)) {
            Blade::component('w4laravelkit-select2', SelectComponent2::class);
        }

        if (class_exists(SelectComponent3::class)) {
            Blade::component('w4laravelkit-select3', SelectComponent3::class);
        }

        if (class_exists(ThemeDropdownComponent::class)) {
            Blade::component('w4laravelkit-themedropdown', ThemeDropdownComponent::class);
        }

        // ✅ Registrar Componentes Livewire solo si existen

        if (class_exists(TableRefresherComponent::class)) {
            Livewire::component('w4laravelkit.tableRefresh', TableRefresherComponent::class);
        }

        if (class_exists(ToastComponent::class)) {
            Livewire::component('w4laravelkit.toast', ToastComponent::class);
        }

        if (class_exists(SessionFlashComponent::class)) {
            Livewire::component('w4laravelkit.sessionflash', SessionFlashComponent::class);
        }
    }
}
