<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

interface HttpClientInterface
{
    public function sendRequest(RequestInterface $request): ResponseInterface;
}
