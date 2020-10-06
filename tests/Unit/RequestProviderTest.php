<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Tests\Unit;

use CodeblogPro\GeoCoder\Exceptions\InvalidArgumentException;
use CodeblogPro\GeoCoder\Http\Request;
use CodeblogPro\GeoCoder\Tests\BlanksAndMocksAndConstants;

class RequestProviderTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructWithValidInputDataToRequestObjectCreated(): void
    {
        $request = new Request(
            BlanksAndMocksAndConstants::getValidMethodValue(),
            BlanksAndMocksAndConstants::getValidUrl(),
            BlanksAndMocksAndConstants::getValidBody(),
            BlanksAndMocksAndConstants::getValidHeaders(),
            BlanksAndMocksAndConstants::getValidHttpVersion()
        );

        $this->assertInstanceOf(Request::class, $request);
    }

    public function testConstructWithWrongMethodToExceptionReturned(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $request = new Request(
            BlanksAndMocksAndConstants::getInValidMethodValue(),
            BlanksAndMocksAndConstants::getValidUrl(),
            BlanksAndMocksAndConstants::getValidBody(),
            BlanksAndMocksAndConstants::getValidHeaders(),
            BlanksAndMocksAndConstants::getValidHttpVersion()
        );
    }

    public function testConstructWithEmptyUrlToExceptionReturned(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $request = new Request(
            BlanksAndMocksAndConstants::getValidMethodValue(),
            BlanksAndMocksAndConstants::getInValidUrl(),
            BlanksAndMocksAndConstants::getValidBody(),
            BlanksAndMocksAndConstants::getValidHeaders(),
            BlanksAndMocksAndConstants::getValidHttpVersion()
        );
    }

    public function testConstructWithWrongVersionToExceptionReturned(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $request = new Request(
            BlanksAndMocksAndConstants::getValidMethodValue(),
            BlanksAndMocksAndConstants::getValidUrl(),
            BlanksAndMocksAndConstants::getValidBody(),
            BlanksAndMocksAndConstants::getValidHeaders(),
            BlanksAndMocksAndConstants::getInValidHttpVersion()
        );
    }
}
