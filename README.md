# Transaction Commission Calculator

A PHP-based command-line tool for calculating transaction commissions based on BIN (Bank Identification Number) lookup and exchange rates. This project demonstrates how to use external APIs for fetching data and perform calculations.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP installed on your system.
- Composer installed for managing dependencies.
- Create a `.env` file in the project root directory to store your environment variables. You can use the provided `.env.example` as a template.

## Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/your-username/transaction-commission-calculator.git
   ```

2. Change to the project directory:

   ```shell
   cd transaction-commission-calculator
   ```

3. Install dependencies using Composer:

   ```shell
   composer install
   ```

4. Modify the `.env` file:

- Provide your API access key as API_ACCESS_KEY.
- Set the BIN_LOOKUP_URL and EXCHANGE_RATE_URL to the URLs of your BIN lookup

5. Create an `input.txt` file with transaction data. You can use the provided `input.txt.example` as a template.

## Usage

To run the Transaction Commission Calculator, use the following command:

```shell
php index.php input.txt
```

- Replace `input.txt` with the name of your input file containing transaction data.

## Results

The tool will calculate commissions for each transaction and display the results on the console.

## External Providers

The project includes external providers for fetching BIN lookup and exchange rate data:

- ExternalBinLookupProvider for BIN lookup using the provided URL.
- ExternalExchangeRateProvider for fetching exchange rates using the provided URL.

These providers use environment variables to configure URLs and API access.

## Contributing

Contributions are welcome! Feel free to open issues or create pull requests to improve this project.

## License

This project is licensed under the MIT License. See the LICENSE file for details.
