<?php

declare(strict_types=1);

/*
 * This file is part of the community-maintained Playwright PHP project.
 * It is not affiliated with or endorsed by Microsoft.
 *
 * (c) 2025-Present - Playwright PHP <https://github.com/playwright-php>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Playwright\Device\Tests;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

use function Playwright\Device\Update\compareDeviceCatalogs;
use function Playwright\Device\Update\formatDeviceCatalogDiff;
use function Playwright\Device\Update\normalizePlaywrightVersion;
use function Playwright\Device\Update\parsePlaywrightVersion;
use function Playwright\Device\Update\sourceUrl;
use function Playwright\Device\Update\writeDevicesFile;

require_once __DIR__.'/../bin/update-devices-functions.php';

#[CoversNothing]
class UpdateDevicesTest extends TestCase
{
    public function testParsesPlaywrightVersionOption(): void
    {
        $this->assertSame('1.63.0', parsePlaywrightVersion(['--playwright-version=1.63.0']));
        $this->assertSame('1.63.0', parsePlaywrightVersion(['--playwright-version', 'v1.63.0']));
    }

    public function testRejectsMissingPlaywrightVersion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The --playwright-version option is required.');

        parsePlaywrightVersion([]);
    }

    public function testRejectsInvalidPlaywrightVersion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid Playwright version');

        normalizePlaywrightVersion('main');
    }

    public function testBuildsUrlForImmutablePlaywrightTag(): void
    {
        $url = sourceUrl('1.63.0');

        $this->assertSame(
            'https://raw.githubusercontent.com/microsoft/playwright/v1.63.0/packages/isomorphic/deviceDescriptorsSource.json',
            $url,
        );
        $this->assertStringNotContainsString('/main/', $url);
    }

    public function testWritesLoadableDevicesFileWithSourceVersion(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'playwright-devices-');
        $this->assertNotFalse($path);

        $devices = [
            'Test Phone' => [
                'ua' => 'Test-UA',
                'dbt' => 'chromium',
                'sf' => 2.0,
                'vp' => [390, 790],
            ],
        ];

        try {
            writeDevicesFile($path, $devices, '1.63.0');

            $this->assertSame($devices, require $path);
            $this->assertStringContainsString(
                'Generated from Microsoft Playwright v1.63.0 device descriptors.',
                (string) file_get_contents($path),
            );
        } finally {
            unlink($path);
        }
    }

    public function testFormatsSemanticCatalogDiff(): void
    {
        $before = [
            'Desktop Edge' => [
                'ua' => 'Mozilla/5.0 Chrome/152.0.1 Safari/537.36 Edg/152.0.1',
                'dbt' => 'chromium',
                'vp' => [1280, 720],
            ],
            'Phone A' => [
                'ua' => 'Mozilla/5.0 Chrome/152.0.1 Safari/537.36',
                'dbt' => 'chromium',
                'vp' => [390, 790],
            ],
            'Phone B' => [
                'ua' => 'Mozilla/5.0 Chrome/152.0.1 Safari/537.36',
                'dbt' => 'chromium',
                'vp' => [400, 800],
            ],
            'Phone C' => [
                'ua' => 'Mozilla/5.0 Android 14 Firefox/153.0',
                'dbt' => 'firefox',
                'vp' => [420, 840],
            ],
            'Tablet A' => [
                'ua' => 'Mozilla/5.0 Version/26.5 Mobile Safari/605.1.15',
                'dbt' => 'webkit',
                'vp' => [820, 1180],
            ],
            'Removed Phone' => [
                'ua' => 'Legacy',
                'dbt' => 'webkit',
                'vp' => [320, 480],
            ],
        ];
        $after = [
            'Desktop Edge' => [
                'ua' => 'Mozilla/5.0 Chrome/153.0.2 Safari/537.36 Edg/153.0.2',
                'dbt' => 'chromium',
                'vp' => [1280, 720],
            ],
            'Phone A' => [
                'ua' => 'Mozilla/5.0 Chrome/153.0.2 Safari/537.36',
                'dbt' => 'chromium',
                'vp' => [390, 790],
            ],
            'Phone B' => [
                'ua' => 'Mozilla/5.0 Chrome/153.0.2 Safari/537.36',
                'dbt' => 'chromium',
                'vp' => [410, 810],
            ],
            'Phone C' => [
                'ua' => 'Mozilla/5.0 Android 15 Firefox/155.0',
                'dbt' => 'firefox',
                'vp' => [420, 840],
            ],
            'Tablet A' => [
                'ua' => 'Mozilla/5.0 Version/26.6 Mobile Safari/605.1.15',
                'dbt' => 'webkit',
                'vp' => [820, 1180],
            ],
            'Added Phone' => [
                'ua' => 'New',
                'dbt' => 'webkit',
                'vp' => [430, 850],
            ],
        ];

        $report = formatDeviceCatalogDiff(compareDeviceCatalogs($before, $after), '1.62.0', '1.63.0');

        $this->assertSame(<<<'REPORT'
## Device descriptor changes

Source: Playwright v1.62.0 -> Playwright v1.63.0

Devices: 6 -> 6
Added: 1
Removed: 1
Changed: 5
Added devices: Added Phone
Removed devices: Removed Phone

Changed properties:
- userAgent: 5
- viewport: 1
- landscapeViewport: 0
- screen: 0
- deviceScaleFactor: 0
- mobile: 0
- touch: 0
- browserType: 0

User-agent replacements:
- Chromium, 2 devices: Chrome 152.0.1 -> 153.0.2
- Chromium, 1 device: Chrome 152.0.1 -> 153.0.2; Edg 152.0.1 -> 153.0.2
- WebKit, 1 device: Version 26.5 -> 26.6
- Other user-agent changes: 1
REPORT.PHP_EOL, $report);
    }
}
