<?php

namespace CommissionCalculator\Tests\External;

use CommissionCalculator\External\ExternalBinLookupProvider;
use CommissionCalculator\Exceptions\BinLookupException;
use PHPUnit\Framework\TestCase;
use phpmock\phpunit\PHPMock;

class ExternalBinLookupProviderTest extends TestCase
{
    use PHPMock;
    /**
     * Test successful BIN lookup.
     */
    public function testSuccessfulBinLookup()
    {
        // Replace with a valid BIN and expected country code
        $validBin = '45717360';
        $expectedCountryCode = 'DK';

        // Create an instance of ExternalBinLookupProvider with a mock URL (replace with a test URL if available)
        $binLookupProvider = new ExternalBinLookupProvider('https://lookup.binlist.net/');

        // Perform the BIN lookup
        $result = $binLookupProvider->lookupBin($validBin);

        // Assert that the result matches the expected country code
        $this->assertEquals(['countryCode' => $expectedCountryCode], $result);
    }

    /**
     * Test failed BIN lookup due to cURL error.
     */
    public function testFailedBinLookupCurlError()
    {
        // Replace with a valid BIN
        $validBin = '123456';

        // Create an instance of ExternalBinLookupProvider with a mock URL (replace with a test URL if available)
        $binLookupProvider = new ExternalBinLookupProvider('https://example.com/bin-lookup/');

        // Expect a BinLookupException to be thrown
        $this->expectException(BinLookupException::class);

        // Perform the BIN lookup (should throw an exception)
        $binLookupProvider->lookupBin($validBin);
    }

    // /**
    //  * Test failed BIN lookup due to invalid response.
    //  */
    public function testFailedBinLookupInvalidResponse()
    {
        // Replace with a valid BIN
        $validBin = '123456';

        // Create an instance of ExternalBinLookupProvider with a mock URL (replace with a test URL if available)
        $binLookupProvider = new ExternalBinLookupProvider('https://example.com/bin-lookup/');

        // Expect a BinLookupException to be thrown
        $this->expectException(BinLookupException::class);

        // Perform the BIN lookup (should throw an exception)
        $binLookupProvider->lookupBin($validBin);
    }
}
