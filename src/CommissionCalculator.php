<?php

namespace CommissionCalculator;

use CommissionCalculator\Exceptions\InvalidArgumentException;

class CommissionCalculator
{
    private $exchangeRateProvider;
    private $binLookupProvider;

    /**
     * Constructor to initialize the CommissionCalculator with providers.
     *
     * @param ExchangeRateProvider $exchangeRateProvider The exchange rate provider.
     * @param BinLookupProvider $binLookupProvider The BIN lookup provider.
     */
    public function __construct(ExchangeRateProvider $exchangeRateProvider, BinLookupProvider $binLookupProvider)
    {
        $this->exchangeRateProvider = $exchangeRateProvider;
        $this->binLookupProvider = $binLookupProvider;
    }

    /**
     * Calculate commissions for an array of transactions.
     *
     * @param array $transactions An array of transaction data.
     *
     * @return array An array of calculated commissions.
     *
     * @throws InvalidArgumentException If the input data is invalid.
     */
    public function calculateCommissions(array $transactions): array
    {
        $commissions = [];

        foreach ($transactions as $transaction) {
            $data = json_decode($transaction, true);

            if (!$data || empty($data['bin']) || empty($data['amount']) || empty($data['currency'])) {
                throw new InvalidArgumentException('Invalid input data.');
            }

            $binInfo = $this->binLookupProvider->lookupBin($data['bin']);
            $isEu = $this->isEu($binInfo['countryCode']);
            $rate = $this->exchangeRateProvider->getExchangeRate($data['currency']);

            $commission = $this->calculateCommission($data['amount'], $rate, $isEu);

            $commissions[] = round($commission, 2);
        }

        return $commissions;
    }

    private function calculateCommission(float $amount, float $rate, bool $isEu): float
    {
        if ($rate === 0) {
            return $amount;
        }

        $amntFixed = $amount / $rate;

        return $amntFixed * ($isEu ? 0.01 : 0.02);
    }

    private function isEu(string $countryCode): bool
    {
        $euCountries = ['AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'];

        return in_array($countryCode, $euCountries);
    }
}
