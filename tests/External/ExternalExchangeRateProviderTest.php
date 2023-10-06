<?php

namespace CommissionCalculator\Tests\External;

use CommissionCalculator\External\ExternalExchangeRateProvider;
use CommissionCalculator\Exceptions\ExchangeRateException;
use PHPUnit\Framework\TestCase;

class ExternalExchangeRateProviderTest extends TestCase
{
    /**
     * Test successful exchange rate retrieval.
     */
    public function testSuccessfulExchangeRateRetrieval()
    {
        // Replace with a valid currency code and expected exchange rate
        $validCurrency = 'USD';
        $expectedExchangeRate = 1.23; // Replace with the expected exchange rate

        // Create an instance of ExternalExchangeRateProvider with a mock URL and API access key
        $exchangeRateProvider = new ExternalExchangeRateProvider('https://example.com/exchange-rate/', 'YOUR_ACCESS_KEY');

        // Mock the cURL response for the test
        $this->mockCurlResponse('{"rates":{"' . $validCurrency . '":' . $expectedExchangeRate . '}}');

        // Perform the exchange rate retrieval
        $result = $exchangeRateProvider->getExchangeRate($validCurrency);

        // Assert that the result matches the expected exchange rate
        $this->assertEquals($expectedExchangeRate, $result);
    }

    /**
     * Test failed exchange rate retrieval due to cURL error.
     */
    public function testFailedExchangeRateRetrievalCurlError()
    {
        // Replace with a valid currency code
        $validCurrency = 'USD';

        // Create an instance of ExternalExchangeRateProvider with a mock URL and API access key
        $exchangeRateProvider = new ExternalExchangeRateProvider('https://example.com/exchange-rate/', 'YOUR_ACCESS_KEY');

        // Mock a cURL error by returning false from curl_exec
        $this->mockCurlResponse(false);

        // Expect an ExchangeRateException to be thrown
        $this->expectException(ExchangeRateException::class);

        // Perform the exchange rate retrieval (should throw an exception)
        $exchangeRateProvider->getExchangeRate($validCurrency);
    }

    /**
     * Test failed exchange rate retrieval due to invalid response.
     */
    public function testFailedExchangeRateRetrievalInvalidResponse()
    {
        // Replace with a valid currency code
        $validCurrency = 'USD';

        // Create an instance of ExternalExchangeRateProvider with a mock URL and API access key
        $exchangeRateProvider = new ExternalExchangeRateProvider('https://example.com/exchange-rate/', 'YOUR_ACCESS_KEY');

        // Mock an invalid JSON response
        $this->mockCurlResponse('Invalid JSON');

        // Expect an ExchangeRateException to be thrown
        $this->expectException(ExchangeRateException::class);

        // Perform the exchange rate retrieval (should throw an exception)
        $exchangeRateProvider->getExchangeRate($validCurrency);
    }

    /**
     * Mock the cURL response for testing.
     *
     * @param mixed $response The response to mock.
     */
    private function mockCurlResponse($response)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://example.com/exchange-rate/'); // Replace with the actual URL

        // Mock curl_exec to return the specified response
        $this->setFunctionOverride('curl_exec', $response, $ch);
    }

    /**
     * Set a function override for testing purposes.
     *
     * @param string $functionName The name of the function to override.
     * @param mixed $returnValue The value to return when the function is called.
     * @param resource|null $resource The resource associated with the function (if applicable).
     */
    private function setFunctionOverride($functionName, $returnValue, $resource = null)
    {
        $namespace = 'CommissionCalculator\External';

        // Override the specified function in the given namespace
        $this->setNamespaceFunctionOverride($namespace, $functionName, $returnValue, $resource);
    }

    /**
     * Set a function override in a specific namespace for testing purposes.
     *
     * @param string $namespace The namespace in which to override the function.
     * @param string $functionName The name of the function to override.
     * @param mixed $returnValue The value to return when the function is called.
     * @param resource|null $resource The resource associated with the function (if applicable).
     */
    private function setNamespaceFunctionOverride($namespace, $functionName, $returnValue, $resource = null)
    {
        $functionName = $namespace . '\\' . $functionName;

        // Override the function to return the specified value
        $this->getFunctionMock($namespace, $functionName)
            ->willReturn($returnValue);

        // If a resource is provided, use it for the overridden function
        if ($resource !== null) {
            $this->getFunctionMock($namespace, $functionName)
                ->with($resource)
                ->willReturn($returnValue);
        }
    }
}
