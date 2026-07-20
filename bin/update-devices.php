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

const SOURCE_URL = 'https://raw.githubusercontent.com/microsoft/playwright/main/packages/isomorphic/deviceDescriptorsSource.json';

$rootDir = dirname(__DIR__);
$jsonPath = $rootDir.'/data/deviceDescriptorsSource.json';
$devicesPath = $rootDir.'/data/devices.php';

try {
    $json = downloadDescriptors(SOURCE_URL);
    writeJsonFile($jsonPath, $json);

    $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    $normalized = normalizeDevices($decoded);

    writeDevicesFile($devicesPath, $normalized);

    info(sprintf('Updated %s and %s', relativePath($jsonPath), relativePath($devicesPath)));
} catch (Throwable $e) {
    fwrite(STDERR, 'Error: '.$e->getMessage().PHP_EOL);
    exit(1);
}

function downloadDescriptors(string $url): string
{
    info('Downloading descriptors from '.$url);

    if (function_exists('curl_init')) {
        $handle = curl_init($url);
        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_USERAGENT => 'playwright-php/devices-updater',
        ]);

        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        $error = curl_error($handle);

        if (false === $response || $httpCode >= 400) {
            throw new RuntimeException(sprintf('cURL download failed (HTTP %s): %s', $httpCode ?: 'n/a', $error ?: 'unknown error'));
        }

        return (string) $response;
    }

    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 60,
            'header' => ['User-Agent: playwright-php/devices-updater'],
        ],
        'https' => [
            'method' => 'GET',
            'timeout' => 60,
            'header' => ['User-Agent: playwright-php/devices-updater'],
        ],
    ]);

    $response = @file_get_contents($url, false, $context);
    if (false === $response) {
        throw new RuntimeException('Failed to download descriptors using file_get_contents');
    }

    return (string) $response;
}

/**
 * @param array<string, array<string, mixed>> $source
 *
 * @return array<string, array<string, mixed>>
 */
function normalizeDevices(array $source): array
{
    $normalized = [];

    foreach ($source as $name => $descriptor) {
        $isLandscape = str_ends_with($name, ' landscape');
        $baseName = $isLandscape ? substr($name, 0, -10) : $name;

        if (!isset($normalized[$baseName])) {
            $normalized[$baseName] = [];
        }

        if ($isLandscape) {
            $normalized[$baseName]['vp_l'] = flattenDimensions($descriptor['viewport']);
            continue;
        }

        $normalized[$baseName]['ua'] = (string) $descriptor['userAgent'];
        $normalized[$baseName]['dbt'] = (string) $descriptor['defaultBrowserType'];
        $normalized[$baseName]['sf'] = (float) $descriptor['deviceScaleFactor'];
        $normalized[$baseName]['vp'] = flattenDimensions($descriptor['viewport']);

        if (isset($descriptor['screen'])) {
            $normalized[$baseName]['sc'] = flattenDimensions($descriptor['screen']);
        } else {
            unset($normalized[$baseName]['sc']);
        }

        $isMobile = $descriptor['isMobile'] ?? null;
        if (false === $isMobile) {
            $normalized[$baseName]['m'] = false;
        } else {
            unset($normalized[$baseName]['m']);
        }

        $hasTouch = $descriptor['hasTouch'] ?? null;
        if (false === $hasTouch) {
            $normalized[$baseName]['t'] = false;
        } else {
            unset($normalized[$baseName]['t']);
        }
    }

    ksort($normalized, SORT_NATURAL | SORT_FLAG_CASE);

    return $normalized;
}

/**
 * @param array{width:int,height:int} $dimensions
 *
 * @return array{0:int,1:int}
 */
function flattenDimensions(array $dimensions): array
{
    return [(int) $dimensions['width'], (int) $dimensions['height']];
}

/**
 * @param array<string, array<string, mixed>> $devices
 */
function writeDevicesFile(string $path, array $devices): void
{
    ensureDirectory(dirname($path));

    $export = var_export($devices, true);
    $export = str_replace('  ', '    ', $export);

    $header = <<<'PHP'
<?php

declare(strict_types=1);

/*
 * This file is part of the community-maintained Playwright PHP project.
 * It is not affiliated with or endorsed by Microsoft.
 *
 * (c) 2025-Present PlaywrightPHP <https://github.com/playwright-php>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return 
PHP;

    $contents = $header.$export.';'.PHP_EOL;

    file_put_contents($path, $contents);
}

function writeJsonFile(string $path, string $contents): void
{
    ensureDirectory(dirname($path));
    file_put_contents($path, json_encode(json_decode($contents, true, 512, JSON_THROW_ON_ERROR), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).PHP_EOL);
}

function ensureDirectory(string $path): void
{
    if (is_dir($path)) {
        return;
    }

    if (!mkdir($path, 0775, true) && !is_dir($path)) {
        throw new RuntimeException('Unable to create directory: '.$path);
    }
}

function relativePath(string $path): string
{
    return ltrim(str_replace(dirname(__DIR__), '', $path), '/');
}

function info(string $message): void
{
    fwrite(STDOUT, $message.PHP_EOL);
}
