# Geo coder service package

[![Build Status](https://travis-ci.org/PanovAlexey/geo-coder.svg?branch=master)](https://travis-ci.org/PanovAlexey/geo-coder) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PanovAlexey/geo-coder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PanovAlexey/geo-coder/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/PanovAlexey/geo-coder/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PanovAlexey/geo-coder/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/PanovAlexey/geo-coder/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Total Downloads](https://poser.pugx.org/codeblog.pro/geo-coder/downloads)](https://packagist.org/packages/codeblog.pro/geo-coder)
[![Version](https://poser.pugx.org/codeblog.pro/geo-coder/version)](https://packagist.org/packages/codeblog.pro/geo-coder)

The geo-coder package helps to determine the coordinates by an address or to get the address by the coordinates. Supports multiple providers.

## Install

Via Composer

``` bash
$ composer require codeblog.pro/geo-coder
```

## Usage

``` php
// Moscow Sheremetyevo International Airport coordinates for example.
$locationOne = $geoCoder->getLocationByCoordinates(55.966784, 37.415715, 'en');
var_dump($locationOne);

// Oslo university address for example
$locationTwo = $geoCoder->getLocationByAddress('Oslo, Problemveien 7, 0315', 'ru');
var_dump($locationTwo);
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email panov@codeblog.pro instead of using the issue tracker.

## Credits

- [Panov Alexey](https://www.linkedin.com/in/codeblog/)

## License

The Apache License License. Please see [License File](LICENSE) for more information.
