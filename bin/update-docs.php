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

require_once __DIR__.'/../vendor/autoload.php';

use Playwright\Device\Device;
use Playwright\Device\DeviceRegistry;

$rootDir = dirname(__DIR__);
$outputPath = $rootDir.'/docs/DEVICES.md';

$registry = new DeviceRegistry();
$devices = $registry->all();
ksort($devices);

$lines = [];
$lines[] = '# Device Catalogue';
$lines[] = '';
$lines[] = 'Generated from Playwright\'s upstream device descriptors ('.date('Y-m-d').').';
$lines[] = '';
$lines[] = '| Device | Browser | Viewport | Landscape | Mobile | Touch | Scale |';
$lines[] = '| --- | --- | --- | --- | --- | --- | --- |';

/** @var Device $device */
foreach ($devices as $device) {
    $portrait = $device->portrait();
    $viewport = formatDimensions($portrait->getViewport());

    $landscape = 'n/a';
    try {
        $landscapeVariant = $portrait->landscape();
        if ($landscapeVariant !== $portrait) {
            $landscape = formatDimensions($landscapeVariant->getViewport());
        }
    } catch (InvalidArgumentException) {
        // Device does not support landscape; keep placeholder.
    }

    $lines[] = sprintf(
        '| %s | %s | %s | %s | %s | %s | %s |',
        $device->getName(),
        ucfirst($device->getDefaultBrowserType()),
        $viewport,
        $landscape,
        $device->isMobile() ? 'Yes' : 'No',
        $device->hasTouch() ? 'Yes' : 'No',
        formatScale($device->getDeviceScaleFactor())
    );
}

file_put_contents($outputPath, implode(PHP_EOL, $lines).PHP_EOL);

echo 'Updated '.relativePath($outputPath).PHP_EOL;

function formatDimensions(?array $dimensions): string
{
    if (null === $dimensions) {
        return 'n/a';
    }

    return sprintf('%d x %d', $dimensions['width'], $dimensions['height']);
}

function formatScale(float $scale): string
{
    $formatted = rtrim(rtrim(number_format($scale, 2, '.', ''), '0'), '.');

    return '' === $formatted ? '0' : $formatted;
}

function relativePath(string $path): string
{
    return ltrim(str_replace(dirname(__DIR__), '', $path), '/');
}
