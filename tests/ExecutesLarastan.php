<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests;

use function dirname;
use function sprintf;

trait ExecutesLarastan
{
    private string $configPath;

    public function execLarastan(string $filename)
    {
        $command = escapeshellcmd(dirname(__DIR__) . '/vendor/phpstan/phpstan/phpstan');

        exec(
            sprintf(
                '%s %s analyse --no-progress --level=max --error-format=%s --configuration=%s %s',
                escapeshellarg(PHP_BINARY),
                $command,
                'json',
                escapeshellarg($this->configPath),
                escapeshellarg($filename)
            ),
            $jsonResult
        );

        return json_decode($jsonResult[0], true, 512, JSON_THROW_ON_ERROR);
    }

    private function analyze(string $file): int
    {
        $result = $this->execLarastan($file);

        if (!$result || $result['totals']['errors'] > 0 || $result['totals']['file_errors'] > 0) {
            $this->fail(json_encode($result, JSON_PRETTY_PRINT));
        }

        return 0;
    }

    /**
     * @return static
     */
    public function setConfigPath(string $configPath): self
    {
        $this->configPath = $configPath;

        return $this;
    }
}
