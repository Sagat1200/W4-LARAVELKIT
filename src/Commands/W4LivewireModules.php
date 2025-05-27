<?php

namespace W4LaravelKit\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class W4LivewireModules extends Command
{
    protected $signature = 'w4laravelkit-module:make-livewire
                            {componentPath : Ruta del componente (ej. Ventas/Form/Crear)}
                            {module : Nombre del módulo (ej. CONTABILIDAD)}
                            {--form : Crear un objeto de formulario Livewire\\Form asociado}
                            {--test : Crear prueba Livewire PHPUnit asociada}
                            {--pest : Usar Pest en lugar de PHPUnit}';

    protected $description = 'Crea un componente Livewire dentro de un módulo de Laravel Modules y lo registra en el ServiceProvider';

    public function handle()
    {
        $componentPath = str_replace('\\', '/', $this->argument('componentPath'));
        $moduleInput = $this->argument('module');

        $modulesBase = base_path('Modules');
        $actualModule = collect(File::directories($modulesBase))
            ->map(fn ($path) => basename($path))
            ->first(fn ($name) => strtolower($name) === strtolower($moduleInput));

        if (!$actualModule) {
            $this->error("❌ El módulo {$moduleInput} no existe en Modules/.");
            return;
        }

        $moduleStudly = Str::studly($actualModule);
        $basePath = "{$modulesBase}/{$actualModule}";

        $pathParts = explode('/', $componentPath);
        $className = Str::studly(array_pop($pathParts));
        $subdir = implode('/', $pathParts);
        $namespace = implode('\\', array_map([Str::class, 'studly'], $pathParts));
        $viewSubdir = implode('.', array_map('strtolower', $pathParts));
        $viewName = Str::kebab($className);

        $classPath = "$basePath/app/Livewire" . ($subdir ? "/{$subdir}" : '') . "/{$className}.php";
        $bladePath = "$basePath/resources/views/livewire" . ($subdir ? "/" . strtolower($subdir) : '') . "/{$viewName}.blade.php";

        File::ensureDirectoryExists(dirname($classPath));
        File::ensureDirectoryExists(dirname($bladePath));

        if ($this->option('form')) {
            $formClassName = $className . 'Form';
            $formNamespace = "Modules\\{$moduleStudly}\\Livewire\\Forms" . ($namespace ? "\\{$namespace}" : '');
            $formPath = "$basePath/app/Livewire/Forms" . ($subdir ? "/{$subdir}" : '') . "/{$formClassName}.php";

            File::ensureDirectoryExists(dirname($formPath));

            if (!File::exists($formPath)) {
                File::put($formPath, $this->getFormStub($formNamespace, $formClassName));
                $this->info("✅ Objeto de formulario creado: {$formPath}");
            } else {
                $this->warn("⚠️ El objeto de formulario ya existe: {$formPath}");
            }
        }

        if (!File::exists($classPath)) {
            $stub = $this->option('form')
                ? $this->getClassStubWithForm($moduleStudly, $namespace, $className, $viewSubdir, $viewName, $formClassName, $formNamespace)
                : $this->getClassStub($moduleStudly, $namespace, $className, $viewSubdir, $viewName);

            File::put($classPath, $stub);
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

        if ($this->option('test')) {
            $testType = $this->option('pest') ? 'Pest' : 'PHPUnit';
            $testNamespace = 'Tests\\Feature\\Livewire';
            $testPath = base_path("tests/Feature/Livewire/{$className}Test.php");
            File::ensureDirectoryExists(dirname($testPath));

            if (!File::exists($testPath)) {
                $stub = $this->option('pest')
                    ? $this->getPestTestStub($className, $moduleStudly, $namespace)
                    : $this->getPhpUnitTestStub($className, $moduleStudly, $namespace);

                File::put($testPath, $stub);
                $this->info("✅ Prueba {$testType} creada: {$testPath}");
            } else {
                $this->warn("⚠️ La prueba ya existe: {$testPath}");
            }
        }

        $livewireTag = strtolower($actualModule) . '::' . ($viewSubdir ? $viewSubdir . '.' : '') . $viewName;
        $fqcn = "Modules\\{$moduleStudly}\\Livewire" . ($namespace ? "\\{$namespace}" : '') . "\\{$className}";

        $registrationLine = "Livewire::component('{$livewireTag}', {$className}::class);";
        $this->line("\n🏦 Renderízalo en Blade con:\n  <livewire:{$livewireTag} />");
        $this->line("\n🧹 Registrando en ServiceProvider...\n  {$registrationLine}");

        $this->injectIntoServiceProvider($actualModule, $registrationLine, $fqcn, $className);
    }

    protected function getPhpUnitTestStub(string $className, string $module, string $namespace): string
    {
        return <<<PHP
<?php

namespace Tests\Feature\Livewire;

use Modules\{$module}\Livewire" . ($namespace ? "\\{$namespace}" : '') . "\\{$className};
use Livewire\Livewire;
use Tests\TestCase;

class {$className}Test extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test({$className}::class)
            ->assertStatus(200);
    }
}
PHP;
    }

    protected function getPestTestStub(string $className, string $module, string $namespace): string
    {
        return <<<PHP
use Modules\{$module}\Livewire" . ($namespace ? "\\{$namespace}" : '') . "\\{$className};
use Livewire\Livewire;

test('renders successfully', function () {
    Livewire::test({$className}::class)
        ->assertStatus(200);
});
PHP;
    }

    protected function getClassStub($moduleStudly, $namespace, $className, $viewSubdir, $viewName): string
    {
        $fullView = strtolower($moduleStudly) . "::livewire" . ($viewSubdir ? ".{$viewSubdir}" : '') . ".{$viewName}";
        $namespaceLine = "Modules\\{$moduleStudly}\\Livewire" . ($namespace ? "\\{$namespace}" : "");

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

    protected function getClassStubWithForm($moduleStudly, $namespace, $className, $viewSubdir, $viewName, $formClassName, $formNamespace): string
    {
        $fullView = strtolower($moduleStudly) . "::livewire" . ($viewSubdir ? ".{$viewSubdir}" : '') . ".{$viewName}";
        $namespaceLine = "Modules\\{$moduleStudly}\\Livewire" . ($namespace ? "\\{$namespace}" : "");

        return <<<PHP
<?php

namespace {$namespaceLine};

use Livewire\Component;
use {$formNamespace}\\{$formClassName};

class {$className} extends Component
{
    public {$formClassName} \$form;

    public function render()
    {
        return view('{$fullView}');
    }
}
PHP;
    }

    protected function getFormStub(string $namespace, string $className): string
    {
        return <<<PHP
<?php

namespace {$namespace};

use Livewire\Form;
use Livewire\Attributes\Validate;

class {$className} extends Form
{
    #[Validate('required')]
    public \$campo = '';
}
PHP;
    }

    protected function getBladeStub(string $className): string
    {
        $quote = strip_tags(preg_replace('/<[^>]+>/', '', \Illuminate\Foundation\Inspiring::quote()));

        return <<<BLADE
<div>
    {{-- Componente {$className} --}}
    {{-- {$quote} --}}
</div>
BLADE;
    }

    protected function injectIntoServiceProvider(string $actualModule, string $lineToAdd, string $fqcn, string $className): void
    {
        $providerPath = base_path("Modules/{$actualModule}/app/Providers/{$actualModule}ServiceProvider.php");

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

