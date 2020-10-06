<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Http;

class GuzzleHttpClient implements HttpClientInterface
{
    private const TIMEOUT_IN_SECONDS = 2;

    public function sendRequest(RequestInterface $request, ?int $timeoutInSeconds = null): ResponseInterface
    {
        $guzzleRequest = new \GuzzleHttp\Psr7\Request(
            $request->getMethod(),
            $request->getUri(),
            $request->getHeaders()
        );

        if (empty($timeoutInSeconds)) {
            $timeoutInSeconds = self::TIMEOUT_IN_SECONDS;
        }

        $guzzleResponse = $this->getGuzzleHttpClient()->send($guzzleRequest, ['timeout' => $timeoutInSeconds]);

        return $this->getResponseByGuzzleResponse($guzzleResponse);
    }

    private function getResponseByGuzzleResponse(\Psr\Http\Message\ResponseInterface $guzzleResponse): ResponseInterface
    {
        return new Response(
            $guzzleResponse->getStatusCode(),
            $guzzleResponse->getBody()->getContents(),
            $guzzleResponse->getHeaders(),
        );
    }

    private function getGuzzleHttpClient(): \GuzzleHttp\Client
    {
        return new \GuzzleHttp\Client();
    }
}
