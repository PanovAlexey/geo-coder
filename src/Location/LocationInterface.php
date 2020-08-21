<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Location;

use CodeblogPro\GeoCoder\Coordinate\CoordinateInterface;

interface LocationInterface
{
    public function getProvidedBy(): string;

    public function getCoordinates(): ?CoordinateInterface;

    public function getCountry(): ?Country;

    public function getRegion(): ?Region;

    public function getCity(): ?City;

    public function getStreetName(): ?string;

    public function getLocality(): ?string;

    public function getPostalCode(): ?string;

    public function getAddressString(): string;

    public function toArray(): array;
}