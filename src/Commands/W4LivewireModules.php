<?php

namespace W4LaravelKit\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class W4LivewireModules extends Command
{
    protected $signature = 'w4laravelkit-module:make-livewire
                            {componentPath : Ruta del componente (ej. Ventas/Form/Crear)}
                            {module : Nombre del módulo (ej. CONTABILIDAD)}';

    protected $description = 'Crea un componente Livewire dentro de un módulo de Laravel Modules y lo registra en el ServiceProvider';

    public function handle()
    {
        $componentPath = str_replace('\\', '/', $this->argument('componentPath'));
        $module = Str::upper($this->argument('module'));

        $pathParts = explode('/', $componentPath);
        $className = Str::studly(array_pop($pathParts));
        $subdir = implode('/', $pathParts);
        $namespace = implode('\\', array_map([Str::class, 'studly'], $pathParts));
        $viewSubdir = implode('.', array_map('strtolower', $pathParts));
        $viewName = Str::kebab($className);
        $basePath = base_path("Modules/{$module}");

        if (!File::exists($basePath)) {
            $this->error("❌ El módulo {$module} no existe.");
            return;
        }

        $classPath = "$basePath/app/Livewire" . ($subdir ? "/{$subdir}" : '') . "/{$className}.php";
        $bladePath = "$basePath/resources/views/livewire" . ($subdir ? "/" . strtolower($subdir) : '') . "/{$viewName}.blade.php";

        File::ensureDirectoryExists(dirname($classPath));
        File::ensureDirectoryExists(dirname($bladePath));

        if (!File::exists($classPath)) {
            File::put($classPath, $this->getClassStub($module, $namespace, $className, $viewSubdir, $viewName));
            $this->info("✅ Clase Livewire creada: {$classPath}");
        } else {
            $this->warn("⚠️ La clase ya existe: {$classPath}");
        }

        if (!File::exists($bladePath)) {
            File::put($bladePath, $this->getBladeStub($className));
            $this->info("✅ Vista Blade creada: {$bladePath}");
        } else {
            $this->warn("⚠️ La vista ya existe: {$bladePath}");
        }

        $livewireTag = strtolower($module) . '::' . ($viewSubdir ? $viewSubdir . '.' : '') . $viewName;
        $fqcn = "Modules\\{$module}\\Livewire" . ($namespace ? "\\{$namespace}" : '') . "\\{$className}";

        $registrationLine = "Livewire::component('{$livewireTag}', {$className}::class);";
        $this->line("\n📦 Renderízalo en Blade con:\n  <livewire:{$livewireTag} />");
        $this->line("\n🧩 Registrando en ServiceProvider...\n  {$registrationLine}");

        $this->injectIntoServiceProvider($module, $registrationLine, $fqcn, $className);
    }

    protected function getClassStub($module, $namespace, $className, $viewSubdir, $viewName): string
    {
        $fullView = strtolower($module) . "::livewire" . ($viewSubdir ? ".{$viewSubdir}" : '') . ".{$viewName}";
        $namespaceLine = "Modules\\{$module}\\Livewire" . ($namespace ? "\\{$namespace}" : "");

        return <<<PHP
<?php

namespace {$namespaceLine};

use Livewire\Component;

class {$className} extends Component
{
    public function render()
    {
        return view('{$fullView}');
    }
}
PHP;
    }

    protected function getBladeStub(string $className): string
    {
        return <<<BLADE
<div>
    {{-- Componente {$className} --}}
    {{ Illuminate\Foundation\Inspiring::quotes()->random() }}
</div>
BLADE;
    }

    protected function injectIntoServiceProvider(string $module, string $lineToAdd, string $fqcn, string $className): void
    {
        $providerPath = base_path("Modules/{$module}/app/Providers/{$module}ServiceProvider.php");

        if (!File::exists($providerPath)) {
            $this->warn("⚠️ ServiceProvider no encontrado: {$providerPath}");
            return;
        }

        $content = File::get($providerPath);

        if (!str_contains($content, 'use Livewire\\Livewire;')) {
            $content = preg_replace('/(namespace .*?;)/', "$1\n\nuse Livewire\\Livewire;", $content, 1);
            $this->info("✅ Se agregó: use Livewire\\Livewire;");
        }

        if (!str_contains($content, "use {$fqcn};")) {
            $content = preg_replace('/(namespace .*?;)/', "$1\n\nuse {$fqcn};", $content, 1);
            $this->info("✅ Se agregó: use {$fqcn};");
        }

        if (str_contains($content, $lineToAdd)) {
            $this->info("ℹ️ Ya estaba registrado en el ServiceProvider.");
        } elseif (preg_match('/^\s*public function boot\s*\(.*?\)\s*:\s*void\s*\{/m', $content, $matches, PREG_OFFSET_CAPTURE)) {
            $pos = $matches[0][1] + strlen($matches[0][0]);
            $before = substr($content, 0, $pos);
            $after = substr($content, $pos);
            $content = $before . "\n        {$lineToAdd}" . $after;
            $this->info("✅ Línea insertada en el método boot() del ServiceProvider.");
        } else {
            $this->warn("⚠️ No se encontró el método boot() en el ServiceProvider.\nAgrega manualmente: {$lineToAdd}");
        }

        File::put($providerPath, $content);
    }
}
