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
}
