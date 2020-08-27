<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

// @ToDo: switch to PSR ResponseInterface instead of my own.
interface ResponseInterface
{
    public function getStatusCode(): int;

    public function getBody();

    public function getHeaders(): array;
}