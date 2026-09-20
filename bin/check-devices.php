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

require_once __DIR__.'/update-devices-functions.php';

use function Playwright\Device\Update\commandArguments;
use function Playwright\Device\Update\compareDeviceCatalogs;
use function Playwright\Device\Update\downloadDescriptors;
use function Playwright\Device\Update\formatDeviceCatalogDiff;
use function Playwright\Device\Update\latestPlaywrightVersion;
use function Playwright\Device\Update\loadDeviceCatalog;
use function Playwright\Device\Update\normalizeDevices;
use function Playwright\Device\Update\parsePlaywrightVersion;
use function Playwright\Device\Update\readRecordedPlaywrightVersion;
use function Playwright\Device\Update\sourceUrl;

$rootDir = dirname(__DIR__);
$devicesPath = $rootDir.'/data/devices.php';
$versionPath = $rootDir.'/data/playwright-version.txt';

try {
    $arguments = commandArguments($_SERVER['argv'] ?? null);
    $recordedVersion = readRecordedPlaywrightVersion($versionPath);
    $expectedVersion = [] === $arguments ? latestPlaywrightVersion() : parsePlaywrightVersion($arguments);
    $currentDevices = loadDeviceCatalog($devicesPath);

    $json = downloadDescriptors(sourceUrl($expectedVersion));
    $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($decoded)) {
        throw new UnexpectedValueException('Playwright descriptors must decode to an object.');
    }

    $expectedDevices = normalizeDevices($decoded);
    $diff = compareDeviceCatalogs($currentDevices, $expectedDevices);
    fwrite(STDOUT, formatDeviceCatalogDiff($diff, $recordedVersion, $expectedVersion));

    if ($recordedVersion !== $expectedVersion || $currentDevices !== $expectedDevices) {
        $updateCommand = [] === $arguments
            ? 'php bin/update-devices.php'
            : sprintf('php bin/update-devices.php --playwright-version=%s', $expectedVersion);

        throw new RuntimeException('Device descriptors are out of date. Run: '.$updateCommand);
    }

    fwrite(STDOUT, sprintf('Device descriptors are up to date with Playwright v%s.'.PHP_EOL, $expectedVersion));
} catch (Throwable $e) {
    fwrite(STDERR, 'Error: '.$e->getMessage().PHP_EOL);
    exit(1);
}
