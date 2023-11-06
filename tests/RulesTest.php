<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithDeprecationHandling;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class RulesTest extends Orchestra
{
    use ExecutesLarastan;
    use InteractsWithDeprecationHandling;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutDeprecationHandling();

        $this->configPath = __DIR__ . '/phpstan-tests.neon';
    }

    /**
     * Returns an array of errors that were found after analyzing $filename.
     */
    protected function findErrors(string $filename): array
    {
        return $this->execLarastan($filename)['files'][$filename] ?? [];
    }

    /**
     * Returns an associative Collection where each key represents the line
     * number and the value represents the error found. Will return
     * at most one error per line.
     *
     * @return array<int, string>
     */
    protected function findErrorsByLine(string $filename): array
    {
        $errors = $this->findErrors(realpath($filename));

        return collect($errors['messages'] ?? [])->mapWithKeys(fn ($message) => [$message['line'] => $message['message']])->toArray();
    }
}
