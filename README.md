<div align="center">
<a href="https://github.com/playwright-php"><img src="https://github.com/playwright-php/.github/raw/main/profile/playwright-php.png" alt="Playwright PHP" /></a>

&nbsp; ![PHP Version](https://img.shields.io/badge/PHP-8.3+-05971B?labelColor=09161E&color=1D8D23&logoColor=FFFFFF)
&nbsp; ![CI](https://img.shields.io/github/actions/workflow/status/playwright-php/devices/CI.yaml?branch=main&label=Tests&color=1D8D23&labelColor=09161E&logoColor=FFFFFF)
&nbsp; ![Release](https://img.shields.io/github/v/release/playwright-php/devices?label=Stable&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)
&nbsp; ![License](https://img.shields.io/github/license/playwright-php/devices?label=License&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)

</div>

# Playwright PHP: Device Descriptors

[Microsoft Playwright](https://github.com/microsoft/playwright) ships an official catalogue
of [device descriptors](https://github.com/microsoft/playwright/blob/main/packages/playwright-core/src/server/deviceDescriptorsSource.json).

This package mirrors that list for [PlaywrightPHP](https://playwright-php.dev) by exporting the JSON data to
`data/devices.php`, and exposes a `DeviceRegistry`
class to retrieve device descriptors by name.

## Installation

```bash
composer require playwright-php/devices
```

## Usage

### Device Registry

```php
use Playwright\Device\DeviceRegistry;

$device = (new DeviceRegistry())->get('iPhone 15 Pro');
```

### Device descriptor

The returned `$device` is an instance of `Playwright\Device\Device`,
with the following methods:

```php
$device->getName();               // 'iPhone 15 Pro'
$device->getUserAgent();          // 'Mozilla/5.0 (iPhone; CPU [...]'
$device->getViewport();           // ['width' => 393, 'height' => 659]
$device->getScreen();             // ['width' => 393, 'height' => 852]
$device->getDeviceScaleFactor();  // 3
$iphone->isMobile();              // true
$iphone->hasTouch();              // true
$iphone->getDefaultBrowserType(); // 'webkit'
```

### Browser emulation

```php
// Pass the device properties to a new browser context:
$browser->newContext([
    'userAgent' => $iphone->getUserAgent(),
    'viewport' => $iphone->getViewport(),
    'isMobile' => $iphone->isMobile(),
    'hasTouch' => $iphone->hasTouch(),
]);

// Or more simply:
$browser->newContext($iphone->toArray());
```

## Descriptors

### Desktop devices

| Device                | Browser  | Viewport   | Scale | Mobile | Touch |
|-----------------------|----------|------------|-------|--------|-------|
| Desktop Chrome        | Chromium | 1280 x 720 | 1     | No     | No    |
| Desktop Chrome HiDPI  | Chromium | 1280 x 720 | 2     | No     | No    |
| Desktop Edge          | Chromium | 1280 x 720 | 1     | No     | No    |
| Desktop Edge HiDPI    | Chromium | 1280 x 720 | 2     | No     | No    |
| Desktop Firefox       | Firefox  | 1280 x 720 | 1     | No     | No    |
| Desktop Firefox HiDPI | Firefox  | 1280 x 720 | 2     | No     | No    |
| Desktop Safari        | Webkit   | 1280 x 720 | 2     | No     | No    |

### Mobile devices

| Device              | Browser  | Viewport   | Scale | Screen     | Viewport |
|---------------------|----------|------------|-------|------------|----------|
| LG Optimus L70      | Chromium | 640 x 384  | 1.25  | 384 x 640  | Yes      |
| iPhone 15 Pro Max   | Webkit   | 814 x 380  | 3     | 430 x 739  | Yes      |
| Kindle Fire HDX     | Webkit   | 1280 x 800 | 2     | 800 x 1280 | Yes      |
| Microsoft Lumia 550 | Chromium | 640 x 360  | 2     | 360 x 640  | Yes      |
| Pixel 7             | Chromium | 863 x 360  | 2.63  | 412 x 839  | Yes      |

Explore the full list of devices in [`docs/DEVICES.md`](docs/DEVICES.md).

## License

This package is released by the [Playwright PHP](https://playwright-php.dev)
project under the MIT License. See the [LICENSE](LICENSE) file for details.
