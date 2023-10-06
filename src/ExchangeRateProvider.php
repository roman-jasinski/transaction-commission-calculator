<?php

namespace CommissionCalculator;

/**
 * Interface for Exchange Rate Providers.
 */
interface ExchangeRateProvider
{
    /**
     * Get the exchange rate for the specified currency.
     *
     * @param string $currency The target currency code.
     *
     * @return float The exchange rate.
     *
     * @throws ExchangeRateException If there's an error during the exchange rate retrieval.
     */
    public function getExchangeRate(string $currency): float;
}
