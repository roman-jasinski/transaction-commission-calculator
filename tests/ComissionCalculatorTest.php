<?php

namespace CommissionCalculator\Tests;

use CommissionCalculator\CommissionCalculator;
use CommissionCalculator\ExchangeRateProvider;
use CommissionCalculator\BinLookupProvider;
use PHPUnit\Framework\TestCase;

class CommissionCalculatorTest extends TestCase
{
    // public function testCalculateCommissions()
    // {
    //     // Create mock objects for ExchangeRateProvider and BinLookupProvider
    //     $exchangeRateProvider = $this->createMock(ExchangeRateProvider::class);
    //     $binLookupProvider = $this->createMock(BinLookupProvider::class);

    //     // Create an instance of the CommissionCalculator with the mock providers
    //     $calculator = new CommissionCalculator($exchangeRateProvider, $binLookupProvider);

    //     // Define test transactions as JSON strings
    //     $transactions = [
    //         '{"bin":"45717360","amount":"100.00","currency":"EUR"}',
    //         '{"bin":"41417360","amount":"130.00","currency":"USD"}',
    //         '{"bin":"4745030","amount":"2000.00","currency":"GBP"}',
    //         // Add more test transactions as needed
    //     ];

    //     // Calculate commissions using the CommissionCalculator
    //     $commissions = $calculator->calculateCommissions($transactions);

    //     // Assert that the calculated commissions match the expected results
    //     $this->assertEquals([1.00, 2.46, 46,25], $commissions); // Adjust expected results accordingly
    // }
}
