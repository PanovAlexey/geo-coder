<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Coordinates;

use CodeblogPro\GeoCoder\Exception\InvalidArgumentException;

class Coordinates implements CoordinatesInterface
{
    private float $latitude;
    private float $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->setLatitudeIsValid($latitude);
        $this->setLongitudeIsValid($longitude);
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function toArray(): array
    {
        return [$this->getLongitude(), $this->getLatitude()];
    }

    private function setLatitudeIsValid($latitude): void
    {
        $isValid = true;

        if (!is_numeric($latitude)) {
            $isValid = false;
        }

        $latitude = (float)$latitude;

        if (!$isValid || $latitude < -90 || $latitude > 90) {
            throw new InvalidArgumentException('Invalid latitude. It must be a number between -90 and 90');
        }

        $this->latitude = $latitude;
    }

    private function setLongitudeIsValid($longitude): void
    {
        $isValid = true;

        if (!is_numeric($longitude)) {
            $isValid = false;
        }

        $longitude = (float)$longitude;

        if (!$isValid || $longitude < -180 || $longitude > 180) {
            throw new InvalidArgumentException('Invalid longitude. It must be a number between -90 and 90');
        }

        $this->longitude = $longitude;
    }
}
