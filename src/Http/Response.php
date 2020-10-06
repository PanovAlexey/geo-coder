<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

use CodeblogPro\GeoCoder\Exceptions\InvalidArgumentException;

class Response implements ResponseInterface
{
    private int $statusCode;
    private string $body;
    private array $headers;

    public function __construct(int $statusCode, string $body, array $headers = [])
    {
        $this->setStatusCodeIsValid($statusCode);
        $this->setBody($body);
        $this->setHeadersIsValid($headers);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    private function setStatusCodeIsValid(int $statusCode): void
    {
        $statusCode = (int)$statusCode;

        if ($statusCode < 100 || $statusCode > 599) {
            throw new InvalidArgumentException('Invalid status code.');
        }

        $this->statusCode = $statusCode;
    }

    private function setBody(string $body): void
    {
        $this->body = $body;
    }

    private function setHeadersIsValid(array $headers): void
    {
        if (!is_array($headers)) {
            throw new InvalidArgumentException('Headers must be an array type.');
        }

        $this->headers = $headers;
    }
}
