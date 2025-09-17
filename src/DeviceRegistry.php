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

namespace Playwright\Device;

/**
 * @phpstan-import-type DeviceDescriptor from Device
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final class DeviceRegistry implements DeviceRegistryInterface
{
    /**
     * @var array<string, DeviceDescriptor>
     */
    private readonly array $descriptors;

    /**
     * @var array<string, Device>
     */
    private array $instances = [];

    public function __construct(?string $devicesFilePath = null)
    {
        $devicesFilePath ??= __DIR__.'/../data/devices.php';

        if (!is_file($devicesFilePath) || !is_readable($devicesFilePath)) {
            throw new \InvalidArgumentException(sprintf('Device file "%s" not found or not readable.', $devicesFilePath));
        }

        /** @var array<string, DeviceDescriptor> $loadedDescriptors */
        $loadedDescriptors = require $devicesFilePath;
        $this->descriptors = $loadedDescriptors;
    }

    public function get(string $name): Device
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        if (!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('Device "%s" not found.', $name));
        }

        $device = $this->buildDevice($name, $this->descriptors[$name]);

        return $this->instances[$name] = $device;
    }

    public function has(string $name): bool
    {
        return isset($this->descriptors[$name]);
    }

    /**
     * Returns all registered Device instances.
     *
     * @return array<string, Device>
     */
    public function all(): array
    {
        foreach (array_keys($this->descriptors) as $name) {
            $this->get($name);
        }

        return $this->instances;
    }

    /**
     * @param DeviceDescriptor $descriptor
     */
    private function buildDevice(string $name, array $descriptor): Device
    {
        return new Device(
            $name,
            $descriptor['ua'],
            $descriptor['dbt'],
            isset($descriptor['sc']) ? ['width' => $descriptor['sc'][0], 'height' => $descriptor['sc'][1]] : null,
            ['width' => $descriptor['vp'][0], 'height' => $descriptor['vp'][1]],
            isset($descriptor['vp_l']) ? ['width' => $descriptor['vp_l'][0], 'height' => $descriptor['vp_l'][1]] : null,
            (float) $descriptor['sf'],
            $descriptor['m'] ?? true,
            $descriptor['t'] ?? true,
        );
    }
}
