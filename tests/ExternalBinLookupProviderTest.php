<?php

namespace CommissionCalculator\Tests\External;

use CommissionCalculator\External\ExternalBinLookupProvider;
use CommissionCalculator\Exceptions\BinLookupException;
use PHPUnit\Framework\TestCase;

class ExternalBinLookupProviderTest extends TestCase
{
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

        // Mock the cURL response for the test
        $this->mockCurlResponse('{"country":{"alpha2":"' . $expectedCountryCode . '"}}');

        // Perform the BIN lookup
        $result = $binLookupProvider->lookupBin($validBin);

        echo 'Results'.json_encode($results);

        // Assert that the result matches the expected country code
        $this->assertEquals(['countryCode' => $expectedCountryCode], $result);
    }

    // /**
    //  * Test failed BIN lookup due to cURL error.
    //  */
    // public function testFailedBinLookupCurlError()
    // {
    //     // Replace with a valid BIN
    //     $validBin = '123456';

    //     // Create an instance of ExternalBinLookupProvider with a mock URL (replace with a test URL if available)
    //     $binLookupProvider = new ExternalBinLookupProvider('https://example.com/bin-lookup/');

    //     // Mock a cURL error by returning false from curl_exec
    //     $this->mockCurlResponse(false);

    //     // Expect a BinLookupException to be thrown
    //     $this->expectException(BinLookupException::class);

    //     // Perform the BIN lookup (should throw an exception)
    //     $binLookupProvider->lookupBin($validBin);
    // }

    // /**
    //  * Test failed BIN lookup due to invalid response.
    //  */
    // public function testFailedBinLookupInvalidResponse()
    // {
    //     // Replace with a valid BIN
    //     $validBin = '123456';

    //     // Create an instance of ExternalBinLookupProvider with a mock URL (replace with a test URL if available)
    //     $binLookupProvider = new ExternalBinLookupProvider('https://example.com/bin-lookup/');

    //     // Mock an invalid JSON response
    //     $this->mockCurlResponse('Invalid JSON');

    //     // Expect a BinLookupException to be thrown
    //     $this->expectException(BinLookupException::class);

    //     // Perform the BIN lookup (should throw an exception)
    //     $binLookupProvider->lookupBin($validBin);
    // }

    // /**
    //  * Mock the cURL response for testing.
    //  *
    //  * @param mixed $response The response to mock.
    //  */
    // private function mockCurlResponse($response)
    // {
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_URL, 'https://example.com/bin-lookup/123456'); // Replace with the actual URL

    //     // Mock curl_exec to return the specified response
    //     $this->setFunctionOverride('curl_exec', $response, $ch);
    // }

    // /**
    //  * Set a function override for testing purposes.
    //  *
    //  * @param string $functionName The name of the function to override.
    //  * @param mixed $returnValue The value to return when the function is called.
    //  * @param resource|null $resource The resource associated with the function (if applicable).
    //  */
    // private function setFunctionOverride($functionName, $returnValue, $resource = null)
    // {
    //     $namespace = 'CommissionCalculator\External';

    //     // Override the specified function in the given namespace
    //     $this->setNamespaceFunctionOverride($namespace, $functionName, $returnValue, $resource);
    // }

    // /**
    //  * Set a function override in a specific namespace for testing purposes.
    //  *
    //  * @param string $namespace The namespace in which to override the function.
    //  * @param string $functionName The name of the function to override.
    //  * @param mixed $returnValue The value to return when the function is called.
    //  * @param resource|null $resource The resource associated with the function (if applicable).
    //  */
    // private function setNamespaceFunctionOverride($namespace, $functionName, $returnValue, $resource = null)
    // {
    //     $functionName = $namespace . '\\' . $functionName;

    //     // Override the function to return the specified value
    //     $this->getFunctionMock($namespace, $functionName)
    //         ->willReturn($returnValue);

    //     // If a resource is provided, use it for the overridden function
    //     if ($resource !== null) {
    //         $this->getFunctionMock($namespace, $functionName)
    //             ->with($resource)
    //             ->willReturn($returnValue);
    //     }
    // }
}
