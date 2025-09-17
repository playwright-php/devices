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
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Playwright\Device\Device;
use Playwright\Device\DeviceRegistry;

#[CoversClass(DeviceRegistry::class)]
#[UsesClass(Device::class)]
class DeviceRegistryTest extends TestCase
{
    private string $devicesFilePath;

    private DeviceRegistry $registry;

    protected function setUp(): void
    {
        parent::setUp();

        $this->devicesFilePath = __DIR__.'/test-devices.php';
        $content = <<<'EOD'
<?php
return [
    'My Test Phone' => [
        'ua' => 'Test-UA-String',
        'dbt' => 'chromium',
        'sc' => [400, 800],
        'vp' => [390, 790],
        'vp_l' => [790, 390],
        'sf' => 3,
    ],
    'My Test Desktop' => [
        'ua' => 'Test-Desktop-UA',
        'm' => false,
        't' => false,
        'dbt' => 'webkit',
        'vp' => [1280, 720],
        'sf' => 1,
    ],
];
EOD;
        file_put_contents($this->devicesFilePath, $content);
        $this->registry = new DeviceRegistry($this->devicesFilePath);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->devicesFilePath)) {
            unlink($this->devicesFilePath);
        }

        unset($this->registry);

        parent::tearDown();
    }

    public function testConstructorThrowsExceptionForInvalidFile(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new DeviceRegistry('invalid/path.php');
    }

    public function testHasReturnsCorrectValue(): void
    {
        $this->assertTrue($this->registry->has('My Test Phone'));
        $this->assertFalse($this->registry->has('Non Existent Device'));
    }

    public function testGetReturnsCorrectDeviceInstance(): void
    {
        $device = $this->registry->get('My Test Phone');

        $this->assertSame('My Test Phone', $device->getName());

        $this->assertTrue($device->isMobile());
        $this->assertTrue($device->hasTouch());

        $desktop = $this->registry->get('My Test Desktop');

        $this->assertFalse($desktop->isMobile());
        $this->assertFalse($desktop->hasTouch());
    }

    public function testGetThrowsExceptionForNonExistingDevice(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->registry->get('Non Existent Device');
    }

    public function testGetCachesDeviceInstances(): void
    {
        $instance1 = $this->registry->get('My Test Phone');
        $instance2 = $this->registry->get('My Test Phone');

        $this->assertSame($instance1, $instance2);
    }

    public function testAllReturnsAllDevices(): void
    {
        $allDevices = $this->registry->all();

        $this->assertCount(2, $allDevices);
        $this->assertArrayHasKey('My Test Phone', $allDevices);
        $this->assertArrayHasKey('My Test Desktop', $allDevices);
        $this->assertInstanceOf(Device::class, $allDevices['My Test Phone']);
        $this->assertInstanceOf(Device::class, $allDevices['My Test Desktop']);
    }
}
