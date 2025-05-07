<?php

namespace W4LaravelKit\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use W4laravelkit\Commands\W4LivewireModules;
use W4laravelkit\Commands\InstallW4LaravelKit;
use App\Livewire\W4LaravelKit\UI\ToastComponent;
use App\View\Components\W4LaravelKit\UI\LinkComponent;
use App\Livewire\W4LaravelKit\UI\SessionFlashComponent;
use App\View\Components\W4LaravelKit\UI\ButtonComponent;
use App\Livewire\W4LaravelKit\UI\CheckboxToggleComponent;
use App\View\Components\W4LaravelKit\UI\InputDateComponent;
use App\View\Components\W4LaravelKit\UI\InputFileComponent;
use App\View\Components\W4LaravelKit\UI\InputTextComponent;
use App\View\Components\W4LaravelKit\UI\PaginatorComponent;
use App\View\Components\W4LaravelKit\Design\HeaderComponent;
use App\View\Components\W4LaravelKit\Design\AppMenuComponent;
use App\View\Components\W4LaravelKit\Design\TableNameComponent;
use App\View\Components\W4LaravelKit\UI\InputTextAreaComponent;
use App\View\Components\W4LaravelKit\UI\ThemeDropdownComponent;
use App\View\Components\W4LaravelKit\Design\CenterHeroComponent;
use App\View\Components\W4LaravelKit\UI\InputTextLowerComponent;
use App\View\Components\W4LaravelKit\UI\InputTextReadOnlyComponent;
use App\View\Components\W4LaravelKit\UI\SelectComponent;

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
                W4LivewireModules::class
            ]);

            // 📌 Publicar Clases y Vistas de componentes en el Proyecto Laravel
            $this->publishes([
                // 📌 AppMenu Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/AppMenuComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/AppMenuComponent.php'),

                // 📌 Appmenu Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/appmenucomponent.blade.php'
                => resource_path('views/components/w4laravelkit/design/appmenucomponent.blade.php'),

                // 📌 Center Hero Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/CenterHeroComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/CenterheroComponent.php'),

                // 📌 Center Hero Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/centerhero-component.blade.php'
                => resource_path('views/components/w4laravelkit/design/centerhero-component.blade.php'),

                // 📌 Header Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/HeaderComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/HeaderComponent.php'),

                // 📌 Header Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/headercomponent.blade.php'
                => resource_path('views/components/w4laravelkit/design/headercomponent.blade.php'),

                // 📌 TableName Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/Design/TableNameComponent.php'
                => app_path('View/Components/W4LaravelKit/Design/TableNameComponent.php'),

                // 📌 Table Name Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/design/tablenamecomponent.blade.php'
                => resource_path('views/components/w4laravelkit/design/tablenamecomponent.blade.php'),

                // 📌 Button Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/ButtonComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/ButtonComponent.php'),

                // 📌 Blade Button Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/buttoncomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/buttoncomponent.blade.php'),

                // 📌 InputDate Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputDateComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputDateComponent.php'),

                // 📌 Blade InputDate Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputdatecomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputdatecomponent.blade.php'),

                // 📌 InputFile Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputFileComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputFileComponent.php'),

                // 📌 Blade InputFile Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputfilecomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputfilecomponent.blade.php'),

                // 📌 InputTextArea Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextAreaComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextAreaComponent.php'),

                // 📌 Blade InputTextArea Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextareacomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextareacomponent.blade.php'),

                // 📌 InputText Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextComponent.php'),

                // 📌 Blade InputText Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextcomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextcomponent.blade.php'),

                // 📌 InputTextLower Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextLowerComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextLowerComponent.php'),

                // 📌 Blade InputTextLower Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextlowercomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextlowercomponent.blade.php'),

                // 📌 InputTextReadOnly Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/InputTextReadOnlyComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/InputTextReadOnlyComponent.php'),

                // 📌 Blade InputTextReadOnly Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/inputtextreadonlycomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/inputtextreadonlycomponent.blade.php'),

                // 📌 Link Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/LinkComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/LinkComponent.php'),

                // 📌 Blade Link Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/linkcomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/linkcomponent.blade.php'),

                // 📌 Paginator Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/PaginatorComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/PaginatorComponent.php'),

                // 📌 Blade Paginator Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/paginatorcomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/paginatorcomponent.blade.php'),

                // 📌 Select Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/SelectComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/SelectComponent.php'),

                // 📌 Blade Select Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/select-component.blade.php'
                => resource_path('views/components/w4laravelkit/ui/select-component.blade.php'),

                // 📌 ThemeDropdown Component
                __DIR__ . '/../Stubs/app/View/Components/W4LaravelKit/UI/ThemeDropdownComponent.php'
                => app_path('View/Components/W4LaravelKit/UI/ThemeDropdownComponent.php'),

                // 📌 Blade ThemeDropdown Component Views
                __DIR__ . '/../Stubs/resources/views/components/w4laravelkit/ui/themedropdowncomponent.blade.php'
                => resource_path('views/components/w4laravelkit/ui/themedropdowncomponent.blade.php'),


                //📌 Livewire Components

                // 📌 Livewire CheckboxToggle Component
                __DIR__ . '/../Stubs/app/Livewire/W4LaravelKit/UI/CheckboxToggleComponent.php'
                => app_path('Livewire/W4LaravelKit/UI/CheckboxToggleComponent.php'),

                // 📌 Livewire checkbox-toggle-component Views
                __DIR__ . '/../Stubs/resources/views/livewire/w4laravelkit/ui/checkbox-toggle-component.blade.php'
                => resource_path('views/livewire/w4laravelkit/ui/checkbox-toggle-component.blade.php'),

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

        // ✅ Registrar Componentes Blade solo si existen
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

        if (class_exists(ButtonComponent::class)) {
            Blade::component('w4laravelkit-button', ButtonComponent::class);
        }

        if (class_exists(InputDateComponent::class)) {
            Blade::component('w4laravelkit-inputDate', InputDateComponent::class);
        }

        if (class_exists(InputFileComponent::class)) {
            Blade::component('w4laravelkit-inputFile', InputFileComponent::class);
        }

        if (class_exists(InputTextAreaComponent::class)) {
            Blade::component('w4laravelkit-inputTextArea', InputTextAreaComponent::class);
        }

        if (class_exists(InputTextComponent::class)) {
            Blade::component('w4laravelkit-inputText', InputTextComponent::class);
        }

        if (class_exists(InputTextLowerComponent::class)) {
            Blade::component('w4laravelkit-inputTextLower', InputTextLowerComponent::class);
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

        if (class_exists(ThemeDropdownComponent::class)) {
            Blade::component('w4laravelkit-themedropdown', ThemeDropdownComponent::class);
        }

        // ✅ Registrar Componentes Livewire solo si existen
        if (class_exists(ToastComponent::class)) {
            Livewire::component('w4laravelkit.toast', ToastComponent::class);
        }

        if (class_exists(CheckboxToggleComponent::class)) {
            Livewire::component('w4laravelkit.checkboxtoggle', CheckboxToggleComponent::class);
        }

        if (class_exists(SessionFlashComponent::class)) {
            Livewire::component('w4laravelkit.sessionflash', SessionFlashComponent::class);
        }
    }
}
