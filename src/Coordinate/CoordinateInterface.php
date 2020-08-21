<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Coordinate;

interface CoordinateInterface
{
    public function getLatitude(): float;

    public function getLongitude(): float;

    public function toArray(): array;
}