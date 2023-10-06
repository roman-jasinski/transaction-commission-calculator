<?php

namespace CommissionCalculator;

/**
 * Interface for BIN (Bank Identification Number) Lookup Providers.
 */
interface BinLookupProvider
{
    /**
     * Lookup BIN information using an external service.
     *
     * @param string $bin The BIN (Bank Identification Number) to lookup.
     *
     * @return array An array containing BIN information.
     *
     * @throws BinLookupException If there's an error during the lookup.
     */
    public function lookupBin(string $bin): array;
}
