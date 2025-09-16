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
interface DeviceRegistryInterface
{
    public function get(string $name): Device;

    public function has(string $name): bool;
}
