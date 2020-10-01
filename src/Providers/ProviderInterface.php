<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Providers;

use CodeblogPro\GeoCoordinates\CoordinatesInterface;
use CodeblogPro\GeoCoder\Location\LocationInterface;

interface ProviderInterface
{
    public function getName(): string;

    public function getLocationByCoordinates(CoordinatesInterface $coordinates, string $locale = ''): LocationInterface;

    public function getLocationByAddress(string $address, string $locale = ''): LocationInterface;
}
