<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder;

use CodeblogPro\GeoCoordinates\Coordinates;
use CodeblogPro\GeoLocationAddress\LocationInterface;
use CodeblogPro\GeoCoder\Providers\ProviderInterface;

class Geocoder implements GeocoderInterface
{
    private ProviderInterface $provider;
    private string $locale;

    public function __construct(ProviderInterface $provider, string $locale = '')
    {
        $this->provider = $provider;
        $this->locale = $locale;
    }

    public function getLocationByCoordinates(float $latitude, float $longitude): LocationInterface
    {
        $coordinates = new Coordinates($latitude, $longitude);

        return $this->provider->getLocationByCoordinates($coordinates, $this->locale);
    }

    public function getLocationByAddress(string $address): LocationInterface
    {
        return $this->provider->getLocationByAddress($address);
    }

    public function getProviderName(): string
    {
        return $this->provider->getName();
    }
}
