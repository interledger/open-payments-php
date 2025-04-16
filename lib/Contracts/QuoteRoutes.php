<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\Quote;
use Psr\Http\Message\ResponseInterface;

interface QuoteRoutes
{
    /**
     * Fetches the latest state of a quote by its ID.
     *
     * @param  array  $reqParams  an array containing the identifier of the quote and the access token.
     */
    public function get(array $reqParams): Quote|ResponseInterface|null;

    /**
     * Creates a new quote.
     *
     * @param  array  $reqParams  The body of the request for creating a quote.
     */
    public function create(array $reqParams, array $quoteRequest): Quote|ResponseInterface|null;
}
