<?php

namespace CodeblogPro\GeoCoder\Tests;

class BlanksAndMocksAndConstants
{
    public static function getValidMethodValue(): string
    {
        return self::getGetMethodValue();
    }

    public static function getGetMethodValue(): string
    {
        return 'get';
    }

    public static function getInValidMethodValue(): string
    {
        return 'dance';
    }

    public static function getValidUrl(): string
    {
        return 'https://geocode-maps.yandex.ru/1.x/?apikey=ваш API-ключ&geocode=37.597576,55.771899';
    }

    public static function getInValidUrl(): string
    {
        return '';
    }

    public static function getValidBody(): string
    {
        return self::getJsonExampleString();
    }

    public static function getValidHeaders(): array
    {
        return self::getEmptyArray();
    }

    public static function getEmptyArray(): array
    {
        return [];
    }

    public static function getJsonExampleString(): string
    {
        return '{
          "country": "USA",
          "region": "Florida"
        }';
    }

    public static function getValidHttpVersion(): string
    {
        return '1.1';
    }

    public static function getInValidHttpVersion(): string
    {
        return '2020.2020';
    }
}
