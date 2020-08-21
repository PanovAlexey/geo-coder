<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder;

use CodeblogPro\GeoCoder\Location\LocationInterface;

interface GeocoderInterface
{
    public function getLocationByCoordinates(): LocationInterface;

    public function getLocationByAddress(): LocationInterface;

    public function getProviderName(): string;
}