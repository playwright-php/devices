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
        $this->assertSame('Test Phone', $this->device->getName());
        $this->assertSame('Test-UA-String', $this->device->getUserAgent());
        $this->assertTrue($this->device->isMobile());
        $this->assertTrue($this->device->hasTouch());
        $this->assertSame('chromium', $this->device->getDefaultBrowserType());
        $this->assertSame(['width' => 400, 'height' => 800], $this->device->getScreen());
        $this->assertSame(3.0, $this->device->getDeviceScaleFactor());
    }

    public function testInitialStateIsPortrait(): void
    {
        $this->assertSame(['width' => 390, 'height' => 790], $this->device->getViewport());
    }

    public function testLandscapeReturnsNewInstanceWithLandscapeViewport(): void
    {
        $landscapeDevice = $this->device->landscape();
        $this->assertNotSame($this->device, $landscapeDevice);
        $this->assertSame(['width' => 790, 'height' => 390], $landscapeDevice->getViewport());
    }

    public function testPortraitReturnsNewInstanceWithPortraitViewport(): void
    {
        $landscapeDevice = $this->device->landscape();
        $portraitDevice = $landscapeDevice->portrait();
        $this->assertNotSame($landscapeDevice, $portraitDevice);
        $this->assertSame(['width' => 390, 'height' => 790], $portraitDevice->getViewport());
    }

    public function testCallingPortraitOnPortraitDeviceReturnsSelf(): void
    {
        $portraitDevice = $this->device->portrait();
        $this->assertSame($this->device, $portraitDevice);
    }

    public function testCallingLandscapeOnLandscapeDeviceReturnsSelf(): void
    {
        $landscapeDevice = $this->device->landscape();
        $landscapeDevice2 = $landscapeDevice->landscape();
        $this->assertSame($landscapeDevice, $landscapeDevice2);
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

    public function testDeviceToArray(): void
    {
        $device = new Device(
            name: 'Test Phone',
            userAgent: 'Test-UA-String',
            defaultBrowserType: 'chromium',
            screen: ['width' => 400, 'height' => 800],
            viewport: ['width' => 390, 'height' => 790],
            viewportLandscape: ['width' => 790, 'height' => 390],
            deviceScaleFactor: 3.0,
        );

        $expectedArray = [
            'name' => 'Test Phone',
            'userAgent' => 'Test-UA-String',
            'defaultBrowserType' => 'chromium',
            'screen' => ['width' => 400, 'height' => 800],
            'viewport' => ['width' => 390, 'height' => 790],
            'deviceScaleFactor' => 3.0,
            'isMobile' => true,
            'hasTouch' => true,
        ];

        $this->assertSame($expectedArray, $device->toArray());

        $device = $device->landscape();
        $expectedArray['viewport'] = ['width' => 790, 'height' => 390];

        $this->assertSame($expectedArray, $device->toArray());
    }
}
