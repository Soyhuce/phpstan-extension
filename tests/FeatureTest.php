<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use function dirname;

/**
 * @coversNothing
 */
class FeatureTest extends Orchestra
{
    use ExecutesLarastan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configPath = __DIR__ . '/Features/phpstan-tests.neon';
    }

    public function getFeatures(): array
    {
        $calls = [];
        $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'Features' . DIRECTORY_SEPARATOR;

        /** @var SplFileInfo $file */
        foreach ((new Finder())->in($baseDir)->files()->name('*.php')->notName('bootstrap.php') as $file) {
            $fullPath = realpath((string) $file);
            $calls[str_replace($baseDir, '', $fullPath)] = [$fullPath];
        }

        return $calls;
    }

    /**
     * @dataProvider getFeatures
     *
     * @test
     */
    public function features(string $file): void
    {
        $configFile = dirname($file) . '/phpstan-tests.neon';
        if (file_exists($configFile)) {
            $this->configPath = $configFile;
        }

        if ($this->analyze($file) === 0) {
            $this->assertTrue(true);
        }
    }
}
