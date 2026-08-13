<div align="center">
<a href="https://github.com/playwright-php"><img src="https://github.com/playwright-php/.github/raw/main/profile/playwright-php.png" alt="Playwright PHP" /></a>

&nbsp; ![PHP Version](https://img.shields.io/badge/PHP-8.2+-05971B?labelColor=09161E&color=1D8D23&logoColor=FFFFFF)
&nbsp; ![CI](https://img.shields.io/github/actions/workflow/status/playwright-php/devices/CI.yaml?branch=main&label=Tests&color=1D8D23&labelColor=09161E&logoColor=FFFFFF)
&nbsp; [![Release](https://img.shields.io/github/v/release/playwright-php/devices?label=Stable&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)](https://packagist.org/packages/playwright-php/devices)
&nbsp; ![License](https://img.shields.io/github/license/playwright-php/devices?label=License&labelColor=09161E&color=1D8D23&logoColor=FFFFFF)

</div>

# Playwright PHP Devices

Use Microsoft Playwright's device descriptors from PHP for repeatable viewport, user agent, touch, and mobile emulation.

## Installation

```bash
composer require playwright-php/devices
```

The package requires PHP 8.2+. Install `playwright-php/playwright` as well when using descriptors in browser automation.

## Quick Start

Load a descriptor by its upstream Playwright device name:

```php
use Playwright\Device\DeviceRegistry;

$device = (new DeviceRegistry())->get('iPhone 15 Pro');

echo $device->getName();
echo $device->getUserAgent();
```

Use its properties when creating a Playwright browser context:

```php
use Playwright\Playwright;

$context = Playwright::webkit([
    'context' => [
        'userAgent' => $device->getUserAgent(),
        'viewport' => $device->getViewport(),
        'screen' => $device->getScreen(),
        'deviceScaleFactor' => $device->getDeviceScaleFactor(),
        'isMobile' => $device->isMobile(),
        'hasTouch' => $device->hasTouch(),
    ],
]);

$page = $context->newPage();
$page->goto('https://example.com');

echo $page->title();

$context->close();
```

The descriptor exposes its preferred browser engine through `getDefaultBrowserType()`. Choose the matching Playwright engine when browser-specific behavior matters.

## Orientation

Descriptors that provide a landscape viewport can be changed without mutating the original object:

```php
$landscape = $device->landscape();

echo $landscape->getViewport()['width'];
```

Calling `landscape()` on a descriptor without landscape data throws an `InvalidArgumentException`.

## Catalog

Use `DeviceRegistry::has()` to check a name and `DeviceRegistry::all()` to retrieve the complete catalog.

The generated [device catalog](docs/DEVICES.md) lists every available descriptor and its browser, screen, viewport, scale, mobile, and touch values.

Device descriptors emulate browser-visible properties. They do not reproduce physical hardware, operating-system UI, network conditions, or device performance.

## Documentation

- [Device catalog](docs/DEVICES.md)
- [Playwright PHP Getting Started](https://github.com/playwright-php/playwright/blob/main/docs/guide/getting-started.md)

## Contributing

Contributions are welcome. Before submitting a pull request, run:

```bash
composer validate --strict
vendor/bin/php-cs-fixer fix --dry-run --diff
vendor/bin/phpstan analyse
vendor/bin/phpunit
```

## License

Playwright PHP Devices is released under the [MIT License](LICENSE).
