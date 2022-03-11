<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension;

use Soyhuce\PhpstanExtension\Commands\PhpstanExtensionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PhpstanExtensionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('phpstan-extension')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_phpstan-extension_table')
            ->hasCommand(PhpstanExtensionCommand::class);
    }
}
