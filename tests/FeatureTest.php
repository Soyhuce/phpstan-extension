<?php declare(strict_types=1);

namespace Soyhuce\PhpstanExtension\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use function dirname;

#[CoversNothing]
class FeatureTest extends Orchestra
{
    use ExecutesLarastan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configPath = __DIR__ . '/Features/phpstan-tests.neon';
    }

    public static function getFeatures(): array
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

    #[Test]
    #[DataProvider('getFeatures')]
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
