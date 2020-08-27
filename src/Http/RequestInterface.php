<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

// @ToDo: switch to PSR ResponseInterface instead of my own.
interface RequestInterface
{
    public function getMethod(): string;

    public function getUri(): string;

    public function getBody();

    public function getHeaders(): array;

    public function getVersion(): string;
}