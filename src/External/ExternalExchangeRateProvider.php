<?php

namespace CommissionCalculator\External;

use CommissionCalculator\ExchangeRateProvider;
use CommissionCalculator\Exceptions\ExchangeRateException;

class ExternalExchangeRateProvider implements ExchangeRateProvider
{
    private $accessKey; // Your API access key
    private $exchangeRateUrl; // The URL for fetching exchange rates

    /**
     * Constructor to initialize the ExternalExchangeRateProvider with an API access key.
     *
     * @param string $exchangeRateUrl The URL for fetching exchange rates.
     * @param string $accessKey The API access key.
     */
    public function __construct(string $exchangeRateUrl, string $accessKey)
    {
        $this->exchangeRateUrl = $exchangeRateUrl;
        $this->accessKey = $accessKey;
    }

    /**
     * Get the exchange rate for the specified currency.
     *
     * @param string $currency The target currency code.
     *
     * @return float The exchange rate.
     *
     * @throws ExchangeRateException If there's an error during the exchange rate retrieval.
     */
    public function getExchangeRate(string $currency): float
    {
        $exchangeRateUrl = $this->exchangeRateUrl . '?access_key=' . $this->accessKey;

        // Initialize cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $exchangeRateUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle cURL error
            throw new ExchangeRateException('Error while retrieving exchange rates.');
        }

        // Parse the JSON response
        $exchangeData = json_decode($response, true);

        // Check if the response was successfully parsed
        if (!$exchangeData || !isset($exchangeData['rates'][$currency])) {
            // Handle invalid response
            throw new ExchangeRateException('Invalid response from exchange rate service.');
        }

        // Extract the exchange rate for the specified currency
        $rate = $exchangeData['rates'][$currency];

        // Close cURL
        curl_close($ch);

        return (float) $rate;
    }
}
