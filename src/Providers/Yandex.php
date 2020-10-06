<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Providers;

use CodeblogPro\GeoCoder\Http\ResponseInterface;
use CodeblogPro\GeoCoordinates\Coordinates;
use CodeblogPro\GeoCoordinates\CoordinatesInterface;
use CodeblogPro\GeoCoder\Exceptions\InvalidRequestException;
use CodeblogPro\GeoCoder\Http\HttpClientInterface;
use CodeblogPro\GeoCoder\Http\Request;
use CodeblogPro\GeoLocationAddress\Country;
use CodeblogPro\GeoLocationAddress\Region;
use CodeblogPro\GeoLocationAddress\Location;
use CodeblogPro\GeoLocationAddress\LocationInterface;

/**
 * Class Yandex
 * You can find out more about this provider API here:
 * https://yandex.ru/dev/maps/geocoder/doc/desc/concepts/input_params.html
 *
 * @package CodeblogPro\GeoCoder\Providers
 */
class Yandex extends AbstractProvider implements ProviderInterface
{
    private const ENDPOINT_URL = 'https://geocode-maps.yandex.ru/1.x/?format=json';
    private const HTTP_VERSION = '1.1';

    private HttpClientInterface $client;
    private ?string $apiKey = null;

    public function __construct(HttpClientInterface $client, string $apiKey = null)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getLocationByCoordinates(CoordinatesInterface $coordinates, string $locale = ''): LocationInterface
    {
        $request = new Request(
            $this->getMethod(),
            self::ENDPOINT_URL . $this->getKeyUrlParam() . $this->getLocaleUrlParamByLocale($locale)
            . $this->getCoordinatesUrlParamByCoordinates($coordinates) . $this->getSearchPrecisionUrlParam(),
            $this->getBody(),
            $this->getHeaders(),
            self::HTTP_VERSION
        );

        $response = $this->client->sendRequest($request);

        return $this->getLocationByResponse($response);
    }

    public function getLocationByAddress(string $address, string $locale = ''): LocationInterface
    {
        $request = new Request(
            $this->getMethod(),
            self::ENDPOINT_URL . $this->getKeyUrlParam() . $this->getLocaleUrlParamByLocale($locale)
            . $this->getAddressUrlParamByAddress($address) . $this->getSearchPrecisionUrlParam(),
            $this->getBody(),
            $this->getHeaders(),
            self::HTTP_VERSION
        );

        $response = $this->client->sendRequest($request);

        return $this->getLocationByResponse($response);
    }

    private function getKeyUrlParam(): string
    {
        return '&apikey=' . $this->apiKey;
    }

    private function getLocaleUrlParamByLocale(string $locale): string
    {
        if ($locale === 'en') {
            return '&lang=en_US';
        }

        return '&lang=ru_RU';
    }

    private function getCoordinatesUrlParamByCoordinates(CoordinatesInterface $coordinates): string
    {
        return '&geocode=' . $coordinates->getLongitude() . ',' . $coordinates->getLatitude();
    }

    private function getAddressUrlParamByAddress(string $address): string
    {
        $addressResult = '';

        foreach (explode(' ', $address) as $addressPart) {
            if (!empty(trim($addressPart))) {
                $addressResult .= '+' . trim($addressPart);
            }
        }

        $addressResult = '&geocode=' . $addressResult;

        return $addressResult;
    }

    private function getSearchPrecisionUrlParam(): string
    {
        // @ToDo: implement the ability to set the search accuracy. For example: return '&kind=locality';
        return '';
    }

    private function getMethod(): string
    {
        return 'GET';
    }

    private function getHeaders(): array
    {
        return [];
    }

    private function getBody(): string
    {
        return '';
    }

    private function getLocationByResponse(ResponseInterface $response): LocationInterface
    {
        $this->httpStatusCodeValidation((int)$response->getStatusCode());

        if (!$this->isJson($response->getBody())) {
            throw new InvalidRequestException('Invalid body format. JSON format expected.');
        }

        $body = json_decode($response->getBody(), true);

        $resultsCount = isset($body['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['results'])
            ? (int)$body['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['results']
            : 0;

        if ($resultsCount <= 0) {
            return new Location();
        }

        $generalizingLocationArray = [];

        foreach ($body['response']['GeoObjectCollection']['featureMember'] as $objectItem) {
            array_walk_recursive(
                $objectItem['GeoObject'],
                function ($value, $key) use (&$generalizingLocationArray) {
                    $generalizingLocationArray[$key] = $value;
                }
            );
        }

        if (!empty($body['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point'])) {
            $coordinatesString = $body['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['Point']['pos'];
        }

        if (empty($coordinatesString)) {
            $coordinatesString = $generalizingLocationArray['pos'];
        }

        $coordinatesArray = explode(' ', $coordinatesString);
        $coordinates = null;

        if (!empty($coordinatesArray[0]) && !empty($coordinatesArray[1])) {
            $coordinates = new Coordinates($coordinatesArray[1], $coordinatesArray[0]);
        }

        $country = null;

        if (!empty($generalizingLocationArray['CountryName'] || !empty($generalizingLocationArray['country_code']))) {
            $country = new Country(
                $generalizingLocationArray['CountryName'],
                $generalizingLocationArray['country_code']
            );
        }

        $region = null;

        if (!empty($generalizingLocationArray['AdministrativeAreaName'])) {
            $region = new Region($generalizingLocationArray['AdministrativeAreaName']);
        }

        return new Location(
            $coordinates,
            $country,
            $region,
            $generalizingLocationArray['LocalityName'] ?? '',
            $generalizingLocationArray['ThoroughfareName'] ?? '',
            $generalizingLocationArray['PostalCodeNumber'] ?? '',
        );
    }
}
