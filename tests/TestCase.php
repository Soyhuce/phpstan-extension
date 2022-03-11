<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Soyhuce\PhpstanExtension\PhpstanExtensionServiceProvider;

/**
 * @coversNothing
 */
class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Soyhuce\\PhpstanExtension\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            PhpstanExtensionServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_phpstan-extension_table.php.stub';
        $migration->up();
        */
    }
}
