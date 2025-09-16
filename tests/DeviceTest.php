<?php

declare(strict_types=1);

/*
 * This file is part of the Playwright PHP community project.
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Playwright\Tests\Device;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Playwright\Device\Device;

#[CoversClass(Device::class)]
class DeviceTest extends TestCase
{
    private Device $device;

    protected function setUp(): void
    {
        parent::setUp();

        $this->device = new Device(
            name: 'Test Phone',
            userAgent: 'Test-UA-String',
            defaultBrowserType: 'chromium',
            screen: ['width' => 400, 'height' => 800],
            viewport: ['width' => 390, 'height' => 790],
            viewportLandscape: ['width' => 790, 'height' => 390],
            deviceScaleFactor: 3.0,
        );
    }

    public function testGettersReturnCorrectValues(): void
    {
        self::assertSame('Test Phone', $this->device->getName());
        self::assertSame('Test-UA-String', $this->device->getUserAgent());
        self::assertTrue($this->device->isMobile());
        self::assertTrue($this->device->hasTouch());
        self::assertSame('chromium', $this->device->getDefaultBrowserType());
        self::assertSame(['width' => 400, 'height' => 800], $this->device->getScreen());
        self::assertSame(3.0, $this->device->getDeviceScaleFactor());
    }

    public function testInitialStateIsPortrait(): void
    {
        self::assertSame(['width' => 390, 'height' => 790], $this->device->getViewport());
    }

    public function testLandscapeReturnsNewInstanceWithLandscapeViewport(): void
    {
        $landscapeDevice = $this->device->landscape();
        self::assertNotSame($this->device, $landscapeDevice);
        self::assertSame(['width' => 790, 'height' => 390], $landscapeDevice->getViewport());
    }

    public function testPortraitReturnsNewInstanceWithPortraitViewport(): void
    {
        $landscapeDevice = $this->device->landscape();
        $portraitDevice = $landscapeDevice->portrait();
        self::assertNotSame($landscapeDevice, $portraitDevice);
        self::assertSame(['width' => 390, 'height' => 790], $portraitDevice->getViewport());
    }

    public function testCallingPortraitOnPortraitDeviceReturnsSelf(): void
    {
        $portraitDevice = $this->device->portrait();
        self::assertSame($this->device, $portraitDevice);
    }

    public function testCallingLandscapeOnLandscapeDeviceReturnsSelf(): void
    {
        $landscapeDevice = $this->device->landscape();
        $landscapeDevice2 = $landscapeDevice->landscape();
        self::assertSame($landscapeDevice, $landscapeDevice2);
    }

    public function testDeviceWithoutLandscapeSupportThrowsException(): void
    {
        $device = new Device(
            name: 'No Landscape',
            userAgent: '',
            defaultBrowserType: '',
            screen: null,
            viewport: ['width' => 1, 'height' => 2],
            viewportLandscape: null,
            deviceScaleFactor: 1,
            isMobile: true,
            hasTouch: true
        );
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Device "No Landscape" does not support landscape orientation.');
        $device->landscape();
    }
}
