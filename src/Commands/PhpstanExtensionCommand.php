<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Commands;

use Illuminate\Console\Command;

class PhpstanExtensionCommand extends Command
{
    public $signature = 'phpstan-extension';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
