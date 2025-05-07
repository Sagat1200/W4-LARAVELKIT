<?php

namespace W4laravelkit\Commands;

use Illuminate\Console\Command;

class InstallW4LaravelKit extends Command
{
    protected $signature = 'w4laravelkit:install';

    protected $description = 'Instala Paquetes para la Configuracion Inicial de Proyectos Laravel';

    public function handle()
    {
        $this->info('Instalando W4LaravelKit...');

        // Instalar Livewire
        shell_exec('composer require livewire/livewire');
        shell_exec('php artisan livewire:publish --config');
        shell_exec('php artisan livewire:publish --assets');
        shell_exec('php artisan livewire:stubs');
        shell_exec('php artisan livewire:layout');
        shell_exec('composer require livewire/volt');
        shell_exec('php artisan volt:install');

        // Reemplazar el layout en app.blade.php
        $this->updateAppLayout();

        // Instalar Tailwind CSS y DaisyUI
        shell_exec('npm install tailwindcss@latest @tailwindcss/vite@latest daisyui@latest');

        // Reemplazar vite.config.js
        $this->updateViteConfig();

        // Instalar Livewire PowerGrid
        shell_exec('composer require power-components/livewire-powergrid');
        shell_exec('php artisan vendor:publish --tag=livewire-powergrid-config');
        shell_exec('php artisan vendor:publish --tag=livewire-powergrid-lang');
        shell_exec('php artisan powergrid:update');
        shell_exec('npm i flatpickr --save');
        shell_exec('npm i slim-select');

        // Modificar archivos de frontend
        $this->updateFrontendFiles();

        //Instalar Laravel Lang en Español
        shell_exec('composer require laravel-lang/common');
        shell_exec('php artisan lang:add es');
        shell_exec('php artisan lang:update');

        // Actualizar config/app.php con timezone y locales
        $this->updateAppConfig();

        // Instalar Blade-UI
        shell_exec('composer require blade-ui-kit/blade-ui-kit');
        shell_exec('php artisan vendor:publish --tag=blade-ui-kit-config');

        // Instalar Blade-FontAwesome
        shell_exec('composer require owenvoke/blade-fontawesome');
        shell_exec('php artisan vendor:publish --tag=blade-fontawesome-config');

        // Modificar .env con las variables de entorno necesarias
        $this->updateEnvFile();

        // Instalar Laravel Modules
        shell_exec('composer require nwidart/laravel-modules');
        shell_exec('php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"');

        // Instalar Neuron AI
        shell_exec('composer require inspector-apm/neuron-ai');

        // Instalar Laravel WorkFlow
        shell_exec('composer require laravel-workflow/laravel-workflow');
        shell_exec('php artisan vendor:publish --provider="Workflow\Providers\WorkflowServiceProvider" --tag="migrations"');

         // NUEVO: Modificar config/modules.php para stubs habilitados y path a stubs/nwidart-stubs
         $this->updateModulesConfig();

          // NUEVO: Modificar el master.stub
        $this->updateMasterStub();

         // NUEVO: Ajustar el vite.stub con el nuevo contenido
         $this->updateViteStub();


        // Modificar composer.json para agregar el post-update-cmd
        $this->updateComposerScripts();

        $this->info('✅ W3BLaravelKit instalado correctamente.');
    }

    protected function updateAppLayout()
    {
        $layoutPath = resource_path('views/components/layouts/app.blade.php'); // Ruta de la plantilla

        // Asegurar que el directorio existe
        if (!file_exists(dirname($layoutPath))) {
            mkdir(dirname($layoutPath), 0755, true);
        }

        // Nuevo contenido de la plantilla
        $newContent = <<<HTML
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ \$description ?? '' }}">
    <meta name="keywords" content="{{ \$keywords ?? '' }}">
    <meta name="author" content="{{ \$author ?? '' }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/8b186f73b9.js" crossorigin="anonymous"></script>

    @livewireStyles
    @bukStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{ \$slot }}
    @livewireScripts
    @livewire('w3btlaravelkit.ui.toast-component')
    @bukScripts
</body>

</html>
HTML;

        // Reemplazar el contenido del archivo
        file_put_contents($layoutPath, $newContent);

        $this->info('✅ Se ha actualizado el layout en app.blade.php');
    }

    protected function updateViteConfig()
    {
        $viteConfigPath = base_path('vite.config.js'); // Ruta del archivo

        // Nuevo contenido de vite.config.js
        $newContent = <<<JS
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { fileURLToPath, URL } from 'url';
import fs from 'fs';
import path from 'path';

function collectModuleAssetsPaths(basePath, moduleDir) {
    const modulesPath = path.resolve(basePath, moduleDir);
    
    if (!fs.existsSync(modulesPath)) {
        return [];
    }

    const moduleFolders = fs.readdirSync(modulesPath);
    
    return moduleFolders.flatMap(folder => {
        const jsPath = path.resolve(modulesPath, folder, 'resources/js/app.js');
        const cssPath = path.resolve(modulesPath, folder, 'resources/css/app.css');
        
        return [
            fs.existsSync(jsPath) ? jsPath : null,
            fs.existsSync(cssPath) ? cssPath : null
        ].filter(Boolean); // Filtra los valores null en caso de que no existan archivos
    });
}

// Directorio base de resources
const resourcesPath = fileURLToPath(new URL('./resources', import.meta.url));

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                ...collectModuleAssetsPaths(resourcesPath, '../Modules')
            ],
            refresh: true,
        }),
        tailwindcss(), // Se agrega el plugin de Tailwind CSS 4 para Vite
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
JS;

        // Reemplazar el contenido del archivo
        file_put_contents($viteConfigPath, $newContent);

        $this->info('✅ Se ha actualizado vite.config.js con la nueva configuración.');
    }

    /**
     * Actualiza los archivos CSS y JS del proyecto.
     */
    protected function updateFrontendFiles()
    {
        $cssPath = resource_path('css/app.css');
        $jsPath = resource_path('js/app.js');
        $powerGridCssPath = resource_path('js/app.css');

        // Contenido para app.css
        $cssContent = <<<CSS
@import "tailwindcss";

/* Daisy UI */
@plugin "daisyui" {
  themes: all;
}

@plugin "daisyui/theme" {
  name: "irongoblin";
  default: false;
  prefersdark: false;
  color-scheme: "dark";
  --color-base-100: oklch(28% 0.066 53.813);
  --color-base-200: oklch(42% 0.095 57.708);
  --color-base-300: oklch(47% 0.114 61.907);
  --color-base-content: oklch(97% 0.071 103.193);
  --color-primary: oklch(80% 0.114 19.571);
  --color-primary-content: oklch(25% 0.092 26.042);
  --color-secondary: oklch(0% 0 0);
  --color-secondary-content: oklch(100% 0 0);
  --color-accent: oklch(0% 0 0);
  --color-accent-content: oklch(100% 0 0);
  --color-neutral: oklch(42% 0.095 57.708);
  --color-neutral-content: oklch(98% 0.026 102.212);
  --color-info: oklch(54% 0.245 262.881);
  --color-info-content: oklch(97% 0.014 254.604);
  --color-success: oklch(59% 0.145 163.225);
  --color-success-content: oklch(97% 0.021 166.113);
  --color-warning: oklch(66% 0.179 58.318);
  --color-warning-content: oklch(98% 0.022 95.277);
  --color-error: oklch(58% 0.253 17.585);
  --color-error-content: oklch(96% 0.015 12.422);
  --radius-selector: 1rem;
  --radius-field: 2rem;
  --radius-box: 0.25rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 1;
  --noise: 1;
}

@plugin "daisyui/theme" {
  name: "afkalmost";
  default: false;
  prefersdark: false;
  color-scheme: "dark";
  --color-base-100: oklch(12% 0.042 264.695);
  --color-base-200: oklch(20% 0.042 265.755);
  --color-base-300: oklch(27% 0.041 260.031);
  --color-base-content: oklch(96% 0.007 247.896);
  --color-primary: oklch(87% 0.15 154.449);
  --color-primary-content: oklch(26% 0.065 152.934);
  --color-secondary: oklch(84% 0.143 164.978);
  --color-secondary-content: oklch(26% 0.051 172.552);
  --color-accent: oklch(82% 0.119 306.383);
  --color-accent-content: oklch(29% 0.149 302.717);
  --color-neutral: oklch(37% 0.044 257.287);
  --color-neutral-content: oklch(98% 0.003 247.858);
  --color-info: oklch(78% 0.154 211.53);
  --color-info-content: oklch(30% 0.056 229.695);
  --color-success: oklch(84% 0.238 128.85);
  --color-success-content: oklch(27% 0.072 132.109);
  --color-warning: oklch(85% 0.199 91.936);
  --color-warning-content: oklch(28% 0.066 53.813);
  --color-error: oklch(71% 0.194 13.428);
  --color-error-content: oklch(27% 0.105 12.094);
  --radius-selector: 2rem;
  --radius-field: 0.25rem;
  --radius-box: 0rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 0;
  --noise: 0;
}

@plugin "daisyui/theme" {
  name: "wigglycake";
  default: false;
  prefersdark: false;
  color-scheme: "dark";
  --color-base-100: oklch(29% 0.136 325.661);
  --color-base-200: oklch(40% 0.17 325.612);
  --color-base-300: oklch(45% 0.211 324.591);
  --color-base-content: oklch(95% 0.037 318.852);
  --color-primary: oklch(62% 0.214 259.815);
  --color-primary-content: oklch(97% 0.014 254.604);
  --color-secondary: oklch(65% 0.241 354.308);
  --color-secondary-content: oklch(97% 0.014 343.198);
  --color-accent: oklch(58% 0.233 277.117);
  --color-accent-content: oklch(96% 0.018 272.314);
  --color-neutral: oklch(40% 0.17 325.612);
  --color-neutral-content: oklch(97% 0.017 320.058);
  --color-info: oklch(60% 0.126 221.723);
  --color-info-content: oklch(98% 0.019 200.873);
  --color-success: oklch(64% 0.2 131.684);
  --color-success-content: oklch(98% 0.031 120.757);
  --color-warning: oklch(66% 0.179 58.318);
  --color-warning-content: oklch(98% 0.022 95.277);
  --color-error: oklch(57% 0.245 27.325);
  --color-error-content: oklch(97% 0.013 17.38);
  --radius-selector: 0.5rem;
  --radius-field: 0.25rem;
  --radius-box: 0.5rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 0;
  --noise: 1;
}

@plugin "daisyui/theme" {
  name: "ironicflip";
  default: false;
  prefersdark: false;
  color-scheme: "dark";
  --color-base-100: oklch(12% 0.042 264.695);
  --color-base-200: oklch(20% 0.042 265.755);
  --color-base-300: oklch(27% 0.041 260.031);
  --color-base-content: oklch(96% 0.007 247.896);
  --color-primary: oklch(59% 0.249 0.584);
  --color-primary-content: oklch(97% 0.014 343.198);
  --color-secondary: oklch(58% 0.158 241.966);
  --color-secondary-content: oklch(97% 0.013 236.62);
  --color-accent: oklch(68% 0.162 75.834);
  --color-accent-content: oklch(98% 0.026 102.212);
  --color-neutral: oklch(37% 0.044 257.287);
  --color-neutral-content: oklch(98% 0.003 247.858);
  --color-info: oklch(62% 0.214 259.815);
  --color-info-content: oklch(97% 0.014 254.604);
  --color-success: oklch(70% 0.14 182.503);
  --color-success-content: oklch(98% 0.014 180.72);
  --color-warning: oklch(79% 0.184 86.047);
  --color-warning-content: oklch(98% 0.026 102.212);
  --color-error: oklch(64% 0.246 16.439);
  --color-error-content: oklch(96% 0.015 12.422);
  --radius-selector: 0.5rem;
  --radius-field: 0.25rem;
  --radius-box: 0.25rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 1;
  --noise: 1;
}


@plugin "daisyui/theme" {
  name: "superschool";
  default: false;
  prefersdark: false;
  color-scheme: "light";
  --color-base-100: oklch(98% 0.002 247.839);
  --color-base-200: oklch(96% 0.003 264.542);
  --color-base-300: oklch(92% 0.006 264.531);
  --color-base-content: oklch(21% 0.034 264.665);
  --color-primary: oklch(54% 0.245 262.881);
  --color-primary-content: oklch(97% 0.014 254.604);
  --color-secondary: oklch(58% 0.158 241.966);
  --color-secondary-content: oklch(97% 0.013 236.62);
  --color-accent: oklch(54% 0.281 293.009);
  --color-accent-content: oklch(96% 0.016 293.756);
  --color-neutral: oklch(21% 0.034 264.665);
  --color-neutral-content: oklch(98% 0.002 247.839);
  --color-info: oklch(68% 0.169 237.323);
  --color-info-content: oklch(97% 0.013 236.62);
  --color-success: oklch(69% 0.17 162.48);
  --color-success-content: oklch(97% 0.021 166.113);
  --color-warning: oklch(79% 0.184 86.047);
  --color-warning-content: oklch(98% 0.026 102.212);
  --color-error: oklch(65% 0.241 354.308);
  --color-error-content: oklch(97% 0.014 343.198);
  --radius-selector: 2rem;
  --radius-field: 0.5rem;
  --radius-box: 0.25rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 1;
  --noise: 0;
}


@plugin "daisyui/theme" {
  name: "goatedburn";
  default: false;
  prefersdark: false;
  color-scheme: "dark";
  --color-base-100: oklch(30% 0.056 229.695);
  --color-base-200: oklch(39% 0.07 227.392);
  --color-base-300: oklch(45% 0.085 224.283);
  --color-base-content: oklch(95% 0.045 203.388);
  --color-primary: oklch(70% 0.165 254.624);
  --color-primary-content: oklch(28% 0.091 267.935);
  --color-secondary: oklch(70% 0.191 22.216);
  --color-secondary-content: oklch(25% 0.092 26.042);
  --color-accent: oklch(70% 0.183 293.541);
  --color-accent-content: oklch(28% 0.141 291.089);
  --color-neutral: oklch(52% 0.105 223.128);
  --color-neutral-content: oklch(98% 0.019 200.873);
  --color-info: oklch(68% 0.169 237.323);
  --color-info-content: oklch(97% 0.013 236.62);
  --color-success: oklch(69% 0.17 162.48);
  --color-success-content: oklch(97% 0.021 166.113);
  --color-warning: oklch(70% 0.213 47.604);
  --color-warning-content: oklch(98% 0.016 73.684);
  --color-error: oklch(63% 0.237 25.331);
  --color-error-content: oklch(97% 0.013 17.38);
  --radius-selector: 2rem;
  --radius-field: 1rem;
  --radius-box: 0.5rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 1;
  --noise: 0;
}


@plugin "daisyui/theme" {
  name: "nextfox";
  default: false;
  prefersdark: false;
  color-scheme: "light";
  --color-base-100: oklch(97% 0.013 17.38);
  --color-base-200: oklch(93% 0.032 17.717);
  --color-base-300: oklch(88% 0.062 18.334);
  --color-base-content: oklch(39% 0.141 25.723);
  --color-primary: oklch(80% 0.114 19.571);
  --color-primary-content: oklch(25% 0.092 26.042);
  --color-secondary: oklch(0% 0 0);
  --color-secondary-content: oklch(100% 0 0);
  --color-accent: oklch(81% 0.111 293.571);
  --color-accent-content: oklch(28% 0.141 291.089);
  --color-neutral: oklch(57% 0.245 27.325);
  --color-neutral-content: oklch(97% 0.013 17.38);
  --color-info: oklch(71% 0.143 215.221);
  --color-info-content: oklch(98% 0.019 200.873);
  --color-success: oklch(72% 0.219 149.579);
  --color-success-content: oklch(98% 0.018 155.826);
  --color-warning: oklch(76% 0.188 70.08);
  --color-warning-content: oklch(98% 0.022 95.277);
  --color-error: oklch(64% 0.246 16.439);
  --color-error-content: oklch(96% 0.015 12.422);
  --radius-selector: 0.5rem;
  --radius-field: 2rem;
  --radius-box: 0.25rem;
  --size-selector: 0.25rem;
  --size-field: 0.25rem;
  --border: 1px;
  --depth: 0;
  --noise: 0;
}

/* Custom Variant for dark theme (DaisyUI night) */
@custom-variant dark (&:where([data-theme=night], [data-theme=night] *));

/* Tailwind JIT Sources for PowerGrid */
@source '../../app/Livewire/*Table.php';
@source '../../app/Livewire/**/*Table.php';
@source '../../vendor/power-components/livewire-powergrid/src/Themes/DaisyUI.php';
@source '../../vendor/power-components/livewire-powergrid/resources/views/**/*.php';
CSS;
        
        // Contenido para app.js
        $jsContent = "import './bootstrap';\n// PowerGrid
        \nimport './../../vendor/power-components/livewire-powergrid/dist/powergrid'
        \nimport flatpickr from \"flatpickr\"; \nimport 'flatpickr/dist/flatpickr.min.css';
        \nimport SlimSelect from 'slim-select'
        \nwindow.SlimSelect = SlimSelect";

        // Contenido para PowerGrid CSS
        $powerGridCssContent = "/* PowerGrid */\n@import \"~slim-select/dist/slimselect.css\";";

        // Escribir contenido en los archivos
        file_put_contents($cssPath, $cssContent);
        file_put_contents($jsPath, $jsContent);
        file_put_contents($powerGridCssPath, $powerGridCssContent);

        $this->info('✅ Se han actualizado los archivos CSS y JS.');
    }

    /**
     * Modifica el archivo config/app.php para actualizar timezone, locale, fallback_locale y faker_locale.
     */
    protected function updateAppConfig()
    {
        $configPath = config_path('app.php'); // Ruta del archivo config/app.php

        if (!file_exists($configPath)) {
            $this->error('❌ No se encontró el archivo config/app.php');
            return;
        }

        // Leer el contenido del archivo
        $configContent = file_get_contents($configPath);

        // Reemplazar timezone
        $configContent = preg_replace("/'timezone' => '.*?',/", "'timezone' => 'America/Mexico_City',", $configContent);

        // Reemplazar locale
        $configContent = preg_replace("/'locale' => '.*?',/", "'locale' => env('APP_LOCALE', 'es'),", $configContent);

        // Reemplazar fallback_locale
        $configContent = preg_replace("/'fallback_locale' => '.*?',/", "'fallback_locale' => env('APP_FALLBACK_LOCALE', 'es'),", $configContent);

        // Reemplazar faker_locale
        $configContent = preg_replace("/'faker_locale' => '.*?',/", "'faker_locale' => env('APP_FAKER_LOCALE', 'en_ES'),", $configContent);

        // Guardar los cambios en el archivo
        file_put_contents($configPath, $configContent);

        $this->info('✅ Se ha actualizado config/app.php con los nuevos valores.');
    }

    /**
     * Modifica el archivo .env para agregar APP_LOCALE, APP_FALLBACK_LOCALE y APP_FAKER_LOCALE.
     */
    protected function updateEnvFile()
    {
        $envPath = base_path('.env'); // Ruta del archivo .env

        if (!file_exists($envPath)) {
            $this->error('❌ No se encontró el archivo .env');
            return;
        }

        // Leer el contenido del archivo .env
        $envContent = file_get_contents($envPath);

        // Definir las nuevas variables de entorno
        $newEnvVariables = [
            'APP_LOCALE' => 'es',
            'APP_FALLBACK_LOCALE' => 'es',
            'APP_FAKER_LOCALE' => 'en_ES',
        ];

        foreach ($newEnvVariables as $key => $value) {
            $pattern = "/^{$key}=.*$/m";
            $replacement = "{$key}={$value}";

            // Si la variable ya existe, la reemplazamos, si no, la agregamos al final del archivo
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n{$replacement}";
            }
        }

        // Guardar los cambios en el archivo .env
        file_put_contents($envPath, $envContent);

        $this->info('✅ Se ha actualizado el archivo .env con los nuevos valores.');
    }

    protected function updateModulesConfig()
    {
        $modulesConfigPath = config_path('modules.php');
        if (!file_exists($modulesConfigPath)) {
            $this->error('❌ No se encontró el archivo config/modules.php');
            return;
        }

        $this->info('Actualizando config/modules.php para habilitar stubs y ruta a stubs/nwidart-stubs...');

        // Leemos el contenido de config/modules.php
        $content = file_get_contents($modulesConfigPath);

        // Forzamos "'enabled' => true," dentro del array de stubs
        $content = preg_replace("/('enabled' => )(?:true|false),/", "$1true,", $content);

        // Forzamos "'path' => base_path('stubs/nwidart-stubs')"
        // En caso de que ya existiera algo, lo sobrescribimos
        $pattern = "/('path' => )base_path\((.*?)\)/";
        $replacement = "$1base_path('stubs/nwidart-stubs')";
        $content = preg_replace($pattern, $replacement, $content);

        // Guardamos los cambios
        file_put_contents($modulesConfigPath, $content);

        $this->info('✅ Se ha actualizado config/modules.php correctamente (stubs habilitados y path configurado).');
    }

     /**
     * Sobrescribe el archivo stubs/nwidart-stubs/views/master.stub
     */
    protected function updateMasterStub()
    {
        // Definir la ruta al archivo
        $masterStubPath = base_path('stubs/nwidart-stubs/views/master.stub');

        // Asegurarse de que la carpeta exista
        if (! file_exists(dirname($masterStubPath))) {
            mkdir(dirname($masterStubPath), 0755, true);
        }

        // Nuevo contenido del stub (exactamente el que nos compartiste)
        $newStubContent = <<<HTML
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ \$description ?? '' }}">
    <meta name="keywords" content="{{ \$keywords ?? '' }}">
    <meta name="author" content="{{ \$author ?? '' }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/8b186f73b9.js" crossorigin="anonymous"></script>

    @livewireStyles
    @bukStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-\$LOWER_NAME\$', 'resources/assets/css/app.css') }} --}}
</head>

<body>
    {{--{{ \$slot }}--}}
    @livewireScripts
    @bukScripts
    {{-- Vite JS --}}
    {{-- {{ module_vite('build-\$LOWER_NAME\$', 'resources/assets/js/app.js') }} --}}
</body>

</html>
HTML;

        // Escribir el contenido en el archivo master.stub
        file_put_contents($masterStubPath, $newStubContent);

        $this->info('✅ Se ha actualizado el archivo master.stub en stubs/nwidart-stubs/views.');
    }

     /**
     * Sobrescribe el archivo stubs/nwidart-stubs/vite.stub
     * con el contenido que nos indicaste.
     */
    protected function updateViteStub()
    {
        $viteStubPath = base_path('stubs/nwidart-stubs/vite.stub');

        // Crear carpeta si no existe
        if (! file_exists(dirname($viteStubPath))) {
            mkdir(dirname($viteStubPath), 0755, true);
        }

        // Contenido nuevo de vite.stub
        $newStubContent = <<<JS
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { readdirSync, statSync } from 'fs';
import { join,relative,dirname } from 'path';
import { fileURLToPath } from 'url';

export default defineConfig({
    build: {
        outDir: '../../public/build-\$LOWER_NAME\$',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-\$LOWER_NAME\$',
            input: [
                __dirname + '/resources/assets/css/app.css',
                __dirname + '/resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
// Scen all resources for assets file. Return array
//function getFilePaths(dir) {
//    const filePaths = [];
//
//    function walkDirectory(currentPath) {
//        const files = readdirSync(currentPath);
//        for (const file of files) {
//            const filePath = join(currentPath, file);
//            const stats = statSync(filePath);
//            if (stats.isFile() && !file.startsWith('.')) {
//                const relativePath = 'Modules/\$STUDLY_NAME\$/'+relative(__dirname, filePath);
//                filePaths.push(relativePath);
//            } else if (stats.isDirectory()) {
//                walkDirectory(filePath);
//            }
//        }
//    }
//
//    walkDirectory(dir);
//    return filePaths;
//}
//
//const __filename = fileURLToPath(import.meta.url);
//const __dirname = dirname(__filename);
//
//const assetsDir = join(__dirname, 'resources/assets');
//export const paths = getFilePaths(assetsDir);
//
//
//export const paths = [
//    'Modules/\$STUDLY_NAME\$/resources/assets/sass/app.scss',
//    'Modules/\$STUDLY_NAME\$/resources/assets/js/app.js',
//];
JS;

        file_put_contents($viteStubPath, $newStubContent);

        $this->info('✅ Se ha actualizado el archivo vite.stub en stubs/nwidart-stubs.');
    }



    /**
     * Modifica el composer.json del proyecto raíz para agregar comandos post-update-cmd, merge-plugin y autoload PSR-4.
     */
    protected function updateComposerScripts()
    {
        $composerFile = base_path('composer.json'); // Ubicación del composer.json en el proyecto Laravel

        if (!file_exists($composerFile)) {
            $this->error('❌ No se encontró el archivo composer.json');
            return;
        }

        // Leer el contenido actual del composer.json
        $composerJson = json_decode(file_get_contents($composerFile), true);

        // Asegurar que la clave "scripts" existe
        if (!isset($composerJson['scripts'])) {
            $composerJson['scripts'] = [];
        }

        // Asegurar que "post-update-cmd" existe como array
        if (!isset($composerJson['scripts']['post-update-cmd'])) {
            $composerJson['scripts']['post-update-cmd'] = [];
        }

        // Comandos que queremos agregar
        $commands = [
            "@php artisan vendor:publish --tag=livewire:assets --ansi --force",
            "@php artisan lang:update"
        ];

        // Agregar comandos si no existen
        foreach ($commands as $command) {
            if (!in_array($command, $composerJson['scripts']['post-update-cmd'])) {
                $composerJson['scripts']['post-update-cmd'][] = $command;
                $this->info("✅ Se ha agregado '{$command}' al post-update-cmd en composer.json");
            } else {
                $this->info("⚠️ El comando '{$command}' ya está presente en composer.json");
            }
        }

        // Asegurar que la clave "extra" existe
        if (!isset($composerJson['extra'])) {
            $composerJson['extra'] = [];
        }

        // Asegurar que "laravel" y "dont-discover" existen
        if (!isset($composerJson['extra']['laravel'])) {
            $composerJson['extra']['laravel'] = ["dont-discover" => []];
        }

        // Agregar merge-plugin si no existe
        if (!isset($composerJson['extra']['merge-plugin'])) {
            $composerJson['extra']['merge-plugin'] = [
                "include" => ["Modules/\*/composer.json"]
            ];
            $this->info('✅ Se ha agregado merge-plugin en composer.json');
        } else {
            $this->info('⚠️ merge-plugin ya estaba presente en composer.json');
        }

        // Asegurar que "autoload" y "psr-4" existen
        if (!isset($composerJson['autoload'])) {
            $composerJson['autoload'] = [];
        }

        if (!isset($composerJson['autoload']['psr-4'])) {
            $composerJson['autoload']['psr-4'] = [];
        }

        // Agregar el namespace "W3btech\\W3blaravelkit\\" si no existe
        if (!isset($composerJson['autoload']['psr-4']['W3btech\\W3blaravelkit\\'])) {
            $composerJson['autoload']['psr-4']['W3btech\\W3blaravelkit\\'] = "src/";
            $this->info('✅ Se ha agregado "W3btech\\W3blaravelkit\\" en autoload PSR-4.');
        } else {
            $this->info('⚠️ "W3btech\\W3blaravelkit\\" ya está presente en autoload PSR-4.');
        }

        // Escribir los cambios en el composer.json
        file_put_contents($composerFile, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Ejecutar dump-autoload después de modificar composer.json
        shell_exec('composer dump-autoload');
        $this->info('✅ Se ejecutó composer dump-autoload correctamente.');
    }
}