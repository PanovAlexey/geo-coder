<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder;

use CodeblogPro\GeoLocationAddress\LocationInterface;

interface GeocoderInterface
{
    public function getLocationByCoordinates(float $latitude, float $longitude): LocationInterface;

    public function getLocationByAddress(string $address): LocationInterface;

    public function getProviderName(): string;
}
