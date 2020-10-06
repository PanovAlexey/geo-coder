<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

use CodeblogPro\GeoCoder\Exceptions\InvalidArgumentException;

class Request implements RequestInterface
{
    private const AVAILABLE_METHODS = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    private const AVAILABLE_VERSIONS = ['1.0', '1.1', '2.0'];
    private string $method;
    private string $url;
    private string $body;
    private array $headers;
    private string $version;

    public function __construct(string $method, string $url, string $body, array $headers = [], string $version = '1.1')
    {
        $this->setMethodIsValid($method);
        $this->setUrlIsValid($url);
        $this->setBody($body);
        $this->setHeadersIsValid($headers);
        $this->setVersionIsValid($version);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->url;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    private function setMethodIsValid(string $method): void
    {
        $method = mb_strtoupper(trim((string)$method));

        if (!in_array($method, self::AVAILABLE_METHODS)) {
            throw new InvalidArgumentException(
                'Method can only accept to: '
                . implode(',', self::AVAILABLE_METHODS)
            );
        }

        $this->method = $method;
    }

    private function setUrlIsValid(string $url): void
    {
        $url = trim((string)$url);

        if (empty($url)) {
            throw new InvalidArgumentException('Url cannot be empty.');
        }

        $this->url = $url;
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

    private function setVersionIsValid(string $version): void
    {
        $version = trim((string)$version);

        if (!in_array($version, self::AVAILABLE_VERSIONS)) {
            throw new InvalidArgumentException(
                'Version can only accept to: '
                . implode(',', self::AVAILABLE_VERSIONS)
            );
        }

        $this->version = $version;
    }
}
