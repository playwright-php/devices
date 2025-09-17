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
 * @author Simon André <smn.andre@gmail.com>
 */
interface DeviceRegistryInterface
{
    /**
     * Returns the Device with the given name.
     *
     * @throws \InvalidArgumentException if the device does not exist
     */
    public function get(string $name): Device;

    /**
     * Returns whether a Device with the given name exists.
     */
    public function has(string $name): bool;
}
