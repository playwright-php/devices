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

namespace Playwright\Device\Update;

const SOURCE_URL_TEMPLATE = 'https://raw.githubusercontent.com/microsoft/playwright/v%s/packages/isomorphic/deviceDescriptorsSource.json';
const LATEST_VERSION_URL = 'https://registry.npmjs.org/playwright/latest';

/**
 * @return list<string>
 */
function commandArguments(mixed $arguments): array
{
    if (!is_array($arguments)) {
        throw new \InvalidArgumentException('Command arguments are unavailable.');
    }

    $result = [];
    foreach (array_slice($arguments, 1) as $argument) {
        if (!is_string($argument)) {
            throw new \InvalidArgumentException('Command arguments must be strings.');
        }

        $result[] = $argument;
    }

    return $result;
}

/**
 * @param list<string> $arguments
 */
function parsePlaywrightVersion(array $arguments): string
{
    if (1 === count($arguments) && str_starts_with($arguments[0], '--playwright-version=')) {
        return normalizePlaywrightVersion(substr($arguments[0], strlen('--playwright-version=')));
    }

    if (2 === count($arguments) && '--playwright-version' === $arguments[0]) {
        return normalizePlaywrightVersion($arguments[1]);
    }

    throw new \InvalidArgumentException('The --playwright-version option is required.');
}

function normalizePlaywrightVersion(string $version): string
{
    $version = ltrim(trim($version), 'v');

    if (1 !== preg_match('/^\d+\.\d+\.\d+$/D', $version)) {
        throw new \InvalidArgumentException(sprintf('Invalid Playwright version "%s".', $version));
    }

    return $version;
}

function sourceUrl(string $version): string
{
    return sprintf(SOURCE_URL_TEMPLATE, normalizePlaywrightVersion($version));
}

function latestPlaywrightVersion(): string
{
    fwrite(STDERR, 'Resolving the latest stable Playwright version'.PHP_EOL);

    $decoded = json_decode(download(LATEST_VERSION_URL), true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($decoded) || !isset($decoded['version']) || !is_string($decoded['version'])) {
        throw new \UnexpectedValueException('The npm registry returned no valid Playwright version.');
    }

    return normalizePlaywrightVersion($decoded['version']);
}

function downloadDescriptors(string $url): string
{
    fwrite(STDERR, 'Downloading descriptors from '.$url.PHP_EOL);

    return download($url);
}

function download(string $url): string
{
    if (function_exists('curl_init')) {
        $handle = curl_init($url);
        if (false === $handle) {
            throw new \RuntimeException('Failed to initialize cURL.');
        }

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
            throw new \RuntimeException(sprintf('cURL download failed (HTTP %s): %s', $httpCode ?: 'n/a', $error ?: 'unknown error'));
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
        throw new \RuntimeException('Failed to download descriptors using file_get_contents');
    }

    return (string) $response;
}

/**
 * @param array<array-key, mixed> $source
 *
 * @return array<string, array<string, mixed>>
 */
function normalizeDevices(array $source): array
{
    $normalized = [];

    foreach ($source as $name => $descriptor) {
        if (!is_string($name) || !is_array($descriptor)) {
            throw new \UnexpectedValueException('Every Playwright device descriptor must be a named object.');
        }

        $isLandscape = str_ends_with($name, ' landscape');
        $baseName = $isLandscape ? substr($name, 0, -10) : $name;

        if (!isset($normalized[$baseName])) {
            $normalized[$baseName] = [];
        }

        if ($isLandscape) {
            $normalized[$baseName]['vp_l'] = descriptorDimensions($descriptor, 'viewport', $name);
            continue;
        }

        $normalized[$baseName]['ua'] = descriptorString($descriptor, 'userAgent', $name);
        $normalized[$baseName]['dbt'] = descriptorString($descriptor, 'defaultBrowserType', $name);
        $normalized[$baseName]['sf'] = descriptorFloat($descriptor, 'deviceScaleFactor', $name);
        $normalized[$baseName]['vp'] = descriptorDimensions($descriptor, 'viewport', $name);

        if (isset($descriptor['screen'])) {
            $normalized[$baseName]['sc'] = descriptorDimensions($descriptor, 'screen', $name);
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
 * @return array<string, array<string, mixed>>
 */
function loadDeviceCatalog(string $path): array
{
    if (!is_file($path)) {
        throw new \RuntimeException(sprintf('Device catalog "%s" does not exist.', $path));
    }

    $loaded = require $path;
    if (!is_array($loaded)) {
        throw new \UnexpectedValueException(sprintf('Device catalog "%s" must return an array.', $path));
    }

    $catalog = [];
    foreach ($loaded as $name => $descriptor) {
        if (!is_string($name) || !is_array($descriptor)) {
            throw new \UnexpectedValueException(sprintf('Device catalog "%s" contains an invalid descriptor.', $path));
        }

        $normalizedDescriptor = [];
        foreach ($descriptor as $property => $value) {
            if (!is_string($property)) {
                throw new \UnexpectedValueException(sprintf('Device catalog "%s" contains an invalid descriptor property.', $path));
            }

            $normalizedDescriptor[$property] = $value;
        }

        $catalog[$name] = $normalizedDescriptor;
    }

    return $catalog;
}

function readRecordedPlaywrightVersion(string $path): string
{
    if (!is_file($path)) {
        throw new \RuntimeException(sprintf('Playwright version file "%s" does not exist.', $path));
    }

    return normalizePlaywrightVersion((string) file_get_contents($path));
}

/**
 * @param array<string, array<string, mixed>> $before
 * @param array<string, array<string, mixed>> $after
 *
 * @return array{
 *     beforeCount: int,
 *     afterCount: int,
 *     added: list<string>,
 *     removed: list<string>,
 *     changedCount: int,
 *     properties: array<string, int>,
 *     userAgentReplacements: list<array{engine: string, changes: string, count: int}>,
 *     otherUserAgentChanges: int
 * }
 */
function compareDeviceCatalogs(array $before, array $after): array
{
    $added = array_keys(array_diff_key($after, $before));
    $removed = array_keys(array_diff_key($before, $after));
    sort($added, SORT_NATURAL | SORT_FLAG_CASE);
    sort($removed, SORT_NATURAL | SORT_FLAG_CASE);

    $properties = array_fill_keys(['ua', 'vp', 'vp_l', 'sc', 'sf', 'm', 't', 'dbt'], 0);
    $changedCount = 0;
    $replacementCounts = [];
    $otherUserAgentChanges = 0;

    foreach (array_intersect_key($after, $before) as $name => $afterDescriptor) {
        $beforeDescriptor = $before[$name];
        $deviceChanged = false;

        foreach (array_unique(array_merge(array_keys($beforeDescriptor), array_keys($afterDescriptor))) as $property) {
            $beforeHasProperty = array_key_exists($property, $beforeDescriptor);
            $afterHasProperty = array_key_exists($property, $afterDescriptor);
            if ($beforeHasProperty === $afterHasProperty && (!$beforeHasProperty || $beforeDescriptor[$property] === $afterDescriptor[$property])) {
                continue;
            }

            $deviceChanged = true;
            $properties[$property] = ($properties[$property] ?? 0) + 1;
        }

        if (!$deviceChanged) {
            continue;
        }

        ++$changedCount;
        if (($beforeDescriptor['ua'] ?? null) === ($afterDescriptor['ua'] ?? null)) {
            continue;
        }

        $beforeUserAgent = $beforeDescriptor['ua'] ?? null;
        $afterUserAgent = $afterDescriptor['ua'] ?? null;
        $engine = $afterDescriptor['dbt'] ?? $beforeDescriptor['dbt'] ?? null;
        if (!is_string($beforeUserAgent) || !is_string($afterUserAgent) || !is_string($engine)) {
            ++$otherUserAgentChanges;
            continue;
        }

        $versionChanges = describeUserAgentVersionChanges($beforeUserAgent, $afterUserAgent, $engine);
        if (null === $versionChanges) {
            ++$otherUserAgentChanges;
            continue;
        }

        $key = implode("\0", [$engine, $versionChanges]);
        if (!isset($replacementCounts[$key])) {
            $replacementCounts[$key] = [
                'engine' => $engine,
                'changes' => $versionChanges,
                'count' => 0,
            ];
        }

        ++$replacementCounts[$key]['count'];
    }

    $userAgentReplacements = array_values($replacementCounts);
    usort($userAgentReplacements, static fn (array $left, array $right): int => [$left['engine'], $left['changes']] <=> [$right['engine'], $right['changes']]);

    return [
        'beforeCount' => count($before),
        'afterCount' => count($after),
        'added' => $added,
        'removed' => $removed,
        'changedCount' => $changedCount,
        'properties' => $properties,
        'userAgentReplacements' => $userAgentReplacements,
        'otherUserAgentChanges' => $otherUserAgentChanges,
    ];
}

function describeUserAgentVersionChanges(string $beforeUserAgent, string $afterUserAgent, string $engine): ?string
{
    $versionTokens = match ($engine) {
        'chromium' => [
            ['token' => 'Chrome', 'separator' => '/', 'pattern' => '/\bChrome\/([0-9.]+)/'],
            ['token' => 'Edg', 'separator' => '/', 'pattern' => '/\bEdg\/([0-9.]+)/'],
        ],
        'firefox' => [
            ['token' => 'Firefox', 'separator' => '/', 'pattern' => '/\bFirefox\/([0-9.]+)/'],
            ['token' => 'rv', 'separator' => ':', 'pattern' => '/\brv:([0-9.]+)/'],
        ],
        'webkit' => [
            ['token' => 'Version', 'separator' => '/', 'pattern' => '/\bVersion\/([0-9.]+)/'],
        ],
        default => [],
    };

    $updatedUserAgent = $beforeUserAgent;
    $changes = [];
    foreach ($versionTokens as $versionToken) {
        if (1 !== preg_match($versionToken['pattern'], $beforeUserAgent, $beforeMatches)
            || 1 !== preg_match($versionToken['pattern'], $afterUserAgent, $afterMatches)
            || $beforeMatches[1] === $afterMatches[1]) {
            continue;
        }

        $updatedUserAgent = str_replace(
            $versionToken['token'].$versionToken['separator'].$beforeMatches[1],
            $versionToken['token'].$versionToken['separator'].$afterMatches[1],
            $updatedUserAgent,
            $replacementCount,
        );
        if (1 !== $replacementCount) {
            return null;
        }

        $changes[] = sprintf('%s %s -> %s', $versionToken['token'], $beforeMatches[1], $afterMatches[1]);
    }

    if ([] === $changes || $updatedUserAgent !== $afterUserAgent) {
        return null;
    }

    return implode('; ', $changes);
}

/**
 * @param array{
 *     beforeCount: int,
 *     afterCount: int,
 *     added: list<string>,
 *     removed: list<string>,
 *     changedCount: int,
 *     properties: array<string, int>,
 *     userAgentReplacements: list<array{engine: string, changes: string, count: int}>,
 *     otherUserAgentChanges: int
 * } $diff
 */
function formatDeviceCatalogDiff(array $diff, ?string $beforeVersion, string $afterVersion): string
{
    $engineLabels = [
        'chromium' => 'Chromium',
        'firefox' => 'Firefox',
        'webkit' => 'WebKit',
    ];
    $propertyLabels = [
        'ua' => 'userAgent',
        'vp' => 'viewport',
        'vp_l' => 'landscapeViewport',
        'sc' => 'screen',
        'sf' => 'deviceScaleFactor',
        'm' => 'mobile',
        't' => 'touch',
        'dbt' => 'browserType',
    ];

    $lines = [
        '## Device descriptor changes',
        '',
        sprintf('Source: %s -> Playwright v%s', null === $beforeVersion ? 'previous catalog' : 'Playwright v'.$beforeVersion, $afterVersion),
        '',
        sprintf('Devices: %d -> %d', $diff['beforeCount'], $diff['afterCount']),
        sprintf('Added: %d', count($diff['added'])),
        sprintf('Removed: %d', count($diff['removed'])),
        sprintf('Changed: %d', $diff['changedCount']),
    ];

    if ([] !== $diff['added']) {
        $lines[] = 'Added devices: '.implode(', ', $diff['added']);
    }
    if ([] !== $diff['removed']) {
        $lines[] = 'Removed devices: '.implode(', ', $diff['removed']);
    }

    $lines[] = '';
    $lines[] = 'Changed properties:';
    foreach ($propertyLabels as $property => $label) {
        $lines[] = sprintf('- %s: %d', $label, $diff['properties'][$property] ?? 0);
    }

    if ([] !== $diff['userAgentReplacements'] || $diff['otherUserAgentChanges'] > 0) {
        $lines[] = '';
        $lines[] = 'User-agent replacements:';
        foreach ($diff['userAgentReplacements'] as $replacement) {
            $lines[] = sprintf(
                '- %s, %d device%s: %s',
                $engineLabels[$replacement['engine']] ?? $replacement['engine'],
                $replacement['count'],
                1 === $replacement['count'] ? '' : 's',
                $replacement['changes'],
            );
        }
        if ($diff['otherUserAgentChanges'] > 0) {
            $lines[] = sprintf('- Other user-agent changes: %d', $diff['otherUserAgentChanges']);
        }
    }

    return implode(PHP_EOL, $lines).PHP_EOL;
}

/**
 * @param array<array-key, mixed> $descriptor
 *
 * @return array{0:int,1:int}
 */
function descriptorDimensions(array $descriptor, string $key, string $deviceName): array
{
    $dimensions = $descriptor[$key] ?? null;
    if (!is_array($dimensions)) {
        throw new \UnexpectedValueException(sprintf('Descriptor "%s" has no valid %s dimensions.', $deviceName, $key));
    }

    $width = $dimensions['width'] ?? null;
    $height = $dimensions['height'] ?? null;
    if (!is_int($width) || !is_int($height)) {
        throw new \UnexpectedValueException(sprintf('Descriptor "%s" has invalid %s dimensions.', $deviceName, $key));
    }

    return [$width, $height];
}

/**
 * @param array<array-key, mixed> $descriptor
 */
function descriptorString(array $descriptor, string $key, string $deviceName): string
{
    $value = $descriptor[$key] ?? null;
    if (!is_string($value)) {
        throw new \UnexpectedValueException(sprintf('Descriptor "%s" has no valid %s value.', $deviceName, $key));
    }

    return $value;
}

/**
 * @param array<array-key, mixed> $descriptor
 */
function descriptorFloat(array $descriptor, string $key, string $deviceName): float
{
    $value = $descriptor[$key] ?? null;
    if (!is_int($value) && !is_float($value)) {
        throw new \UnexpectedValueException(sprintf('Descriptor "%s" has no valid %s value.', $deviceName, $key));
    }

    return (float) $value;
}

/**
 * @param array<string, array<string, mixed>> $devices
 */
function writeDevicesFile(string $path, array $devices, string $playwrightVersion): void
{
    ensureDirectory(dirname($path));

    $export = var_export($devices, true);
    $export = str_replace('  ', '    ', $export);

    $header = sprintf(<<<'PHP'
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

// Generated from Microsoft Playwright v%s device descriptors.
PHP, normalizePlaywrightVersion($playwrightVersion));

    file_put_contents($path, $header.PHP_EOL.PHP_EOL.'return '.$export.';'.PHP_EOL);
}

function writeJsonFile(string $path, string $contents): void
{
    ensureDirectory(dirname($path));
    file_put_contents($path, json_encode(json_decode($contents, true, 512, JSON_THROW_ON_ERROR), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES).PHP_EOL);
}

function writeVersionFile(string $path, string $playwrightVersion): void
{
    ensureDirectory(dirname($path));
    file_put_contents($path, normalizePlaywrightVersion($playwrightVersion).PHP_EOL);
}

function ensureDirectory(string $path): void
{
    if (is_dir($path)) {
        return;
    }

    if (!mkdir($path, 0775, true) && !is_dir($path)) {
        throw new \RuntimeException('Unable to create directory: '.$path);
    }
}

function relativePath(string $path): string
{
    return ltrim(str_replace(dirname(__DIR__), '', $path), '/');
}
