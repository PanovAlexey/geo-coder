<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Location;

use CodeblogPro\GeoCoder\Coordinate\CoordinateInterface;

class Location implements LocationInterface
{
    private string $providedBy;
    private ?CoordinateInterface $coordinates;
    private ?Country $country;
    private ?Region $region;
    private ?City $city;
    private ?string $streetName;
    private ?string $locality;
    private ?string $postalCode;

    public function __construct(
        string $providedBy,
        CoordinateInterface $coordinates = null,
        Country $country = null,
        Region $region = null,
        City $city = null,
        string $locality = null,
        string $streetName = null,
        string $postalCode = null
    ) {
        $this->providedBy = $providedBy;
        $this->coordinates = $coordinates;
        $this->country = $country;
        $this->region = $region;
        $this->city = $city;
        $this->locality = $locality;
        $this->streetName = $streetName;
        $this->postalCode = $postalCode;
    }

    public function getCoordinates(): CoordinateInterface
    {
        return $this->coordinates;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function getStreetName(): string
    {
        return $this->streetName;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getAddressString(): string
    {
        $address = '';

        if (!empty($this->getCountry())) {
            $address = $this->getCountry();
        }

        if (!empty($this->getRegion())) {
            $address .= ', ' . $this->getRegion();
        }

        if (!empty($this->getCity())) {
            $address .= ', ' . $this->getCity();
        }

        if (!empty($this->getLocality())) {
            $address .= ', ' . $this->getLocality();
        }

        if (!empty($this->getStreetName())) {
            $address .= ', ' . $this->getStreetName();
        }

        return $address;
    }

    public function toArray(): array
    {
        return [
            'providedBy' => $this->providedBy,
            'latitude' => (!empty($this->getCoordinates()) ? $this->getCoordinates()->getLatitude() : null,
            'longitude' => (!empty($this->getCoordinates()) ? $this->getCoordinates()->getLongitude() : null,
            'country_name' => $this->getCountry()->getName(),
            'country_code' => $this->getCountry()->getCode(),
            'region_name' => $this->getRegion()->getName(),
            'region_code' => $this->getRegion()->getCode(),
            'city_name' => $this->getCity()->getName(),
            'city_code' => $this->getCity()->getCode(),
            'street_name' => $this->getStreetName(),
            'postal_code' => $this->getPostalCode(),
            'locality' => $this->getLocality()
        ];
    }

    public function getProvidedBy(): string
    {
        return $this->providedBy;
    }

    private static function createCoordinates($latitude, $longitude)
    {
        if (null === $latitude || null === $longitude) {
            return null;
        }

        return new Coordinates($latitude, $longitude);
    }

}