<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\Quote;
use Psr\Http\Message\ResponseInterface;

interface QuoteRoutes
{
    /**
     * Fetches the latest state of a quote by its ID.
     *
     * @param string $id The identifier of the quote.
     * @param array $headerParameters The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     */
    public function get(string $id, ?bool $returnArray = false): Quote|ResponseInterface|null;

    /**
     * Creates a new quote.
     *
     * @param mixed $requestBody The body of the request for creating a quote.
     * @param array $headerParameters The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     */
    public function create($requestBody, ?bool $returnArray = false): Quote|ResponseInterface|null;
}
