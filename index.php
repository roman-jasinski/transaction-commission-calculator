<?php

require_once __DIR__ . '/vendor/autoload.php';

use CommissionCalculator\CommissionCalculator;
use CommissionCalculator\External\ExternalExchangeRateProvider;
use CommissionCalculator\External\ExternalBinLookupProvider;
use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get the environment variables
$apiAccessKey = $_ENV['API_ACCESS_KEY'];
$binLookupUrl = $_ENV['BIN_LOOKUP_URL'];
$exchangeRateUrl = $_ENV['EXCHANGE_RATE_URL'];

// Instantiate the ExternalExchangeRateProvider with the API access key and URL
$exchangeRateProvider = new ExternalExchangeRateProvider($exchangeRateUrl, $apiAccessKey);
$binLookupProvider = new ExternalBinLookupProvider($binLookupUrl);

// Create the calculator
$calculator = new CommissionCalculator($exchangeRateProvider, $binLookupProvider);

// Check if the command-line arguments are provided correctly
if ($argc != 2) {
    echo "Usage: php index.php input.txt\n";
    exit(1);
}

// Get the input file name from the command-line argument
$inputFile = $argv[1];

// Read input data from the specified file
$inputData = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($inputData === false) {
    die('Error reading input file.');
}

// Calculate commissions using the retrieved binResults and exchange rates
$results = $calculator->calculateCommissions($inputData);

// Display results
foreach ($results as $result) {
    // Remove trailing zeros and decimal point
    $formattedResult = number_format($result, 2);

    // Echo the formatted result
    echo $formattedResult . PHP_EOL;
}
