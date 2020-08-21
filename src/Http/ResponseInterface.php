<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

interface ResponseInterface
{
    public function getStatusCode(): int;

    public function getBody();

    public function getHeaders(): array;
}