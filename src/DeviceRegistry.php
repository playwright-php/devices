<?php

declare(strict_types=1);

/*
 * This file is part of the Playwright PHP community project.
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Playwright\Device;

/**
 * @author Simon André <smn.andre@gmail.com>
 */
final class DeviceRegistry implements DeviceRegistryInterface
{
    /**
     * @var array<string, array<string, mixed>>
     */
    private readonly array $descriptors;

    /**
     * @var array<string, Device>
     */
    private array $instances = [];

    public function __construct(string $devicesFilePath)
    {
        if (!is_file($devicesFilePath) || !is_readable($devicesFilePath)) {
            throw new \InvalidArgumentException(sprintf('Device file "%s" not found or not readable.', $devicesFilePath));
        }

        /** @var array<string, array<string, mixed>> $loadedDescriptors */
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
     * Devices are instantiated on first access (lazy loading).
     *
     * @return array<string, Device>
     */
    public function all(): array
    {
        foreach (array_keys($this->descriptors) as $name) {
            // This will trigger lazy loading via the get() method
            $this->get($name);
        }

        return $this->instances;
    }

    /**
     * @param array<string, mixed> $descriptor
     */
    private function buildDevice(string $name, array $descriptor): Device
    {
        /** @var array<int, int>|null $screenDimensions */
        $screenDimensions = $descriptor['sc'] ?? null;
        $screen = null;
        if (is_array($screenDimensions)) {
            $screen = ['width' => $screenDimensions[0], 'height' => $screenDimensions[1]];
        }

        /** @var array<int, int> $viewportDimensions */
        $viewportDimensions = $descriptor['vp'];
        $viewport = ['width' => $viewportDimensions[0], 'height' => $viewportDimensions[1]];

        /** @var array<int, int>|null $viewportLandscapeDimensions */
        $viewportLandscapeDimensions = $descriptor['vp_l'] ?? null;
        $viewportLandscape = null;
        if (is_array($viewportLandscapeDimensions)) {
            $viewportLandscape = ['width' => $viewportLandscapeDimensions[0], 'height' => $viewportLandscapeDimensions[1]];
        }

        /** @var string $userAgent */
        $userAgent = $descriptor['ua'];

        /** @var string $defaultBrowserType */
        $defaultBrowserType = $descriptor['dbt'];

        /** @var float $deviceScaleFactor */
        $deviceScaleFactor = $descriptor['sf'];

        /** @var bool $isMobile */
        $isMobile = $descriptor['m'] ?? true;

        /** @var bool $hasTouch */
        $hasTouch = $descriptor['t'] ?? true;

        return new Device(
            $name,
            $userAgent,
            $defaultBrowserType,
            $screen,
            $viewport,
            $viewportLandscape,
            $deviceScaleFactor,
            $isMobile,
            $hasTouch
        );
    }
}
