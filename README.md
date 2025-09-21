<div align="center">
<a href="https://github.com/playwright-php"><img src="https://github.com/playwright-php/.github/raw/main/profile/playwright-php.png" alt="Playwright PHP" /></a>

&nbsp; ![PHP Version](https://img.shields.io/badge/PHP-8.2+-05971B?labelColor=09161E&color=1D8D23&logoColor=FFFFFF)
&nbsp; ![CI](https://img.shields.io/github/actions/workflow/status/playwright-php/devices/CI.yaml?branch=main&label=Tests&color=1D8D23&labelColor=09161E&logoColor=FFFFFF)
&nbsp; ![Release](https://img.shields.io/github/v/release/playwright-php/devices?label=Stable&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)
&nbsp; ![License](https://img.shields.io/github/license/playwright-php/devices?label=License&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)

</div>

# Playwright PHP: Device Descriptors

This package provides the official [device descriptors](https://github.com/microsoft/playwright/blob/main/packages/playwright-core/src/server/deviceDescriptorsSource.json)
from [Microsoft Playwright](https://github.com/microsoft/playwright) for use
with [Playwright PHP](https://playwright-php.dev).

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

## Catalog

| Device                | Browser  | Screen      | Scale | Viewport   | Landscape  | Mobile | Touch |
|-----------------------|----------|-------------|-------|------------|------------|--------|-------|
| Desktop Chrome        | Chromium | 1920 x 1080 | 1     | 1280 x 720 |            | No     | No    |
| Desktop Chrome HiDPI  | Chromium | 1792 x 1120 | 2     | 1280 x 720 |            | No     | No    |
| Desktop Edge          | Chromium | 1920 x 1080 | 1     | 1280 x 720 |            | No     | No    |
| Desktop Edge HiDPI    | Chromium | 1792 x 1120 | 2     | 1280 x 720 |            | No     | No    |
| Desktop Firefox       | Firefox  | 1920 x 1080 | 1     | 1280 x 720 |            | No     | No    |
| Desktop Firefox HiDPI | Firefox  | 1792 x 1120 | 2     | 1280 x 720 |            | No     | No    |
| Desktop Safari        | Webkit   | 1792 x 1120 | 2     | 1280 x 720 |            | No     | No    |
| Blackberry PlayBook   | Webkit   | n/a         | 1     | 600 x 1024 | 1024 x 600 | Yes    | Yes   |
| BlackBerry Z30        | Webkit   | n/a         | 2     | 360 x 640  | 640 x 360  | Yes    | Yes   |
| Galaxy A55            | Chromium | n/a         | 2.25  | 480 x 1040 | 1040 x 480 | Yes    | Yes   |

Explore the full list of devices in [`docs/DEVICES.md`](docs/DEVICES.md).

## License

This package is released by the [Playwright PHP](https://playwright-php.dev)
project under the MIT License. See the [LICENSE](LICENSE) file for details.
