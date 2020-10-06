<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Providers;

use CodeblogPro\GeoCoder\Exceptions\InvalidRequestException;
use CodeblogPro\GeoCoder\Exceptions\InvalidServerResponseException;
use CodeblogPro\GeoCoder\Exceptions\RedirectionServerResponseException;

abstract class AbstractProvider
{
    public function getName(): string
    {
        return get_class($this);
    }

    protected function httpStatusCodeValidation(int $httpStatusCode): void
    {
        if ($httpStatusCode > 299 && $httpStatusCode < 399) {
            throw new RedirectionServerResponseException('HTTP status code=' . $httpStatusCode);
        }

        if ($httpStatusCode > 399 && $httpStatusCode < 499) {
            throw new InvalidRequestException('HTTP status code=' . $httpStatusCode);
        }

        if ($httpStatusCode > 499 && $httpStatusCode < 599) {
            throw new InvalidServerResponseException('HTTP status code=' . $httpStatusCode);
        }
    }

    protected function isJson(string $string): bool
    {
        json_decode($string);

        return (json_last_error() === JSON_ERROR_NONE);
    }
}
