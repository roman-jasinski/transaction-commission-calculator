<?php

namespace CommissionCalculator\External;

use CommissionCalculator\BinLookupProvider;
use CommissionCalculator\Exceptions\BinLookupException;

class ExternalBinLookupProvider implements BinLookupProvider
{
    private $binLookupUrl;

    public function __construct(string $binLookupUrl)
    {
        $this->binLookupUrl = $binLookupUrl;
    }

    /**
     * Lookup BIN information using an external service.
     *
     * @param string $bin The BIN (Bank Identification Number) to lookup.
     *
     * @return array An array containing the country code.
     *
     * @throws BinLookupException If there's an error during the lookup.
     */
    public function lookupBin(string $bin): array
    {
        $binUrl = $this->binLookupUrl . $bin;

        // Initialize cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $binUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle cURL error
            throw new BinLookupException('Error while performing BIN lookup.');
        }

        // Parse the JSON response
        $binData = json_decode($response, true);

        // Check if the response was successfully parsed
        if (!$binData || !isset($binData['country']['alpha2'])) {
            // Handle invalid response
            throw new BinLookupException('Invalid response from BIN lookup service.');
        }

        // Extract the country code
        $countryCode = $binData['country']['alpha2'];

        // Close cURL
        curl_close($ch);

        return ['countryCode' => $countryCode];
    }
}
