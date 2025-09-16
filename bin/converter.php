<?php

declare(strict_types=1);

/*
 * This file is part of the Playwright PHP community project.
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

$jsonPath = __DIR__.'/../data/deviceDescriptorsSource.json';
$outputPath = __DIR__.'/../data/devices.php';

$devices = json_decode(file_get_contents($jsonPath), true);

// Enforce isMobile and hasTouch defaults
foreach ($devices as $name => &$properties) {
    if (str_starts_with($name, 'Desktop')) {
        $properties['isMobile'] = false;
        $properties['hasTouch'] = false;
    } else {
        unset($properties['isMobile']);
        unset($properties['hasTouch']);
    }
}
unset($properties); // Unset reference

// Consolidate landscape and portrait devices
$consolidatedDevices = [];
foreach ($devices as $name => $properties) {
    if (str_ends_with($name, ' landscape')) {
        $baseName = str_replace(' landscape', '', $name);
        if (isset($consolidatedDevices[$baseName])) {
            $consolidatedDevices[$baseName]['viewportLandscape'] = $properties['viewport'];
        }
    } else {
        $consolidatedDevices[$name] = $properties;
        $consolidatedDevices[$name]['viewportLandscape'] = null;
    }
}

// Remap to short keys and string dimensions for smaller file size
$minifiedDevices = [];
foreach ($consolidatedDevices as $name => $properties) {
    $minified = [
        'ua' => $properties['userAgent'],
        'dbt' => $properties['defaultBrowserType'],
        'sf' => $properties['deviceScaleFactor'],
        'vp' => $properties['viewport']['width'].'x'.$properties['viewport']['height'],
    ];

    if (isset($properties['screen'])) {
        $minified['sc'] = $properties['screen']['width'].'x'.$properties['screen']['height'];
    }
    if (isset($properties['viewportLandscape'])) {
        $minified['vp_l'] = $properties['viewportLandscape']['width'].'x'.$properties['viewportLandscape']['height'];
    }
    if (isset($properties['isMobile'])) {
        $minified['m'] = $properties['isMobile'];
    }
    if (isset($properties['hasTouch'])) {
        $minified['t'] = $properties['hasTouch'];
    }

    $minifiedDevices[$name] = $minified;
}

// Generate the PHP file
$phpCode = "<?php\n\nreturn ".var_export($minifiedDevices, true).";\n";

$csFixerPath = __DIR__.'/../vendor/bin/php-cs-fixer';

// Run php-cs-fixer (single pass, as string formatting is handled)
if (file_exists($csFixerPath)) {
    file_put_contents($outputPath, $phpCode); // Write initial content
    $command = escapeshellarg($csFixerPath).' fix '.escapeshellarg($outputPath);
    echo "Running php-cs-fixer...\n";
    $output = shell_exec($command);
    echo "php-cs-fixer output:\n".$output;
} else {
    file_put_contents($outputPath, $phpCode); // Just write if fixer not found
}

echo "Successfully generated consolidated data/devices.php.\n";

echo "Script finished.\n";
