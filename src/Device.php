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
 * @phpstan-type DeviceDescriptor array{
 *   ua: string,
 *   dbt: string,
 *   sc?: array{0:int, 1:int},
 *   vp: array{0:int, 1:int},
 *   vp_l?: array{0:int, 1:int},
 *   sf: float,
 *   m?: bool,
 *   t?: bool,
 * }
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final class Device
{
    private bool $isLandscape = false;

    public function __construct(
        private readonly string $name,
        private readonly string $userAgent,
        private readonly string $defaultBrowserType,
        /** @var array{width: int, height: int}|null */
        private readonly ?array $screen,
        /** @var array{width: int, height: int} */
        private readonly array $viewport,
        /** @var array{width: int, height: int}|null */
        private readonly ?array $viewportLandscape,
        private readonly float $deviceScaleFactor,
        private readonly bool $isMobile = true,
        private readonly bool $hasTouch = true,
    ) {
    }

    public function portrait(): self
    {
        if (!$this->isLandscape) {
            return $this;
        }

        $clone = clone $this;
        $clone->isLandscape = false;

        return $clone;
    }

    public function landscape(): self
    {
        if (null === $this->viewportLandscape) {
            throw new \InvalidArgumentException(sprintf('Device "%s" does not support landscape orientation.', $this->name));
        }

        if ($this->isLandscape) {
            return $this;
        }

        $clone = clone $this;
        $clone->isLandscape = true;

        return $clone;
    }

    /**
     * @return array{width: int, height: int}|null
     */
    public function getViewport(): ?array
    {
        return $this->isLandscape ? $this->viewportLandscape : $this->viewport;
    }

    public function getDefaultBrowserType(): string
    {
        return $this->defaultBrowserType;
    }

    public function getDeviceScaleFactor(): float
    {
        return $this->deviceScaleFactor;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array{width: int, height: int}|null
     */
    public function getScreen(): ?array
    {
        return $this->screen;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function hasTouch(): bool
    {
        return $this->hasTouch;
    }

    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    /**
     * Returns the device descriptor as an array.
     *
     * @return array{
     *   name: string,
     *   userAgent: string,
     *   defaultBrowserType: string,
     *   screen: array{width: int, height: int}|null,
     *   viewport: array{width: int, height: int}|null,
     *   deviceScaleFactor: float,
     *   isMobile: bool,
     *   hasTouch: bool
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'userAgent' => $this->userAgent,
            'defaultBrowserType' => $this->defaultBrowserType,
            'screen' => $this->screen,
            'viewport' => $this->getViewport(),
            'deviceScaleFactor' => $this->deviceScaleFactor,
            'isMobile' => $this->isMobile,
            'hasTouch' => $this->hasTouch,
        ];
    }
}
