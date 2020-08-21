<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Coordinate;

class Coordinate
{
    private $latitude;
    private $longitude;

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
}