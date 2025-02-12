<?php

namespace OpenPayments\Services;

use OpenPayments\Contracts\QuoteRoutes;
use OpenPayments\Models\Quote;
use OpenPayments\OpenApi\Generated\ResourceServer\Exception\{
    GetQuoteUnauthorizedException,
    GetQuoteForbiddenException,
    GetQuoteNotFoundException,
    CreateQuoteBadRequestException,
    CreateQuoteUnauthorizedException,
    CreateQuoteForbiddenException
};
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\Validators\QuoteValidator;
use OpenPayments\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

class QuoteService implements QuoteRoutes
{
  private OpenApiResourceServerClient $openApiClient;
  private QuoteValidator $validator;

    public function __construct(
        OpenApiResourceServerClient $httpClient,
        QuoteValidator $validator)
    {
        $this->openApiClient = $httpClient;

        $this->validator = $validator;
    }

    /**
     * Fetches the latest state of a quote by its ID.
     *
     * @param string $id The identifier of the quote.
     * @param array $headerParameters The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     * @throws GetQuoteUnauthorizedException
     * @throws GetQuoteForbiddenException
     * @throws GetQuoteNotFoundException
     * @throws ValidationException
     */
    public function get(string $id, ?bool $returnArray = false): Quote
    {
        $response = $this->openApiClient->getQuote($id);

        $this->validator->validateResponse($response);

        if (is_array($response)) {
            return new Quote($response);
        } else {
            throw new \UnexpectedValueException('Unexpected response type');
        }
    }

    /**
     * Creates a new quote.
     *
     * @param mixed $requestBody The body of the request for creating a quote.
     * @param array $headerParameters The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     * @throws CreateQuoteBadRequestException
     * @throws CreateQuoteUnauthorizedException
     * @throws CreateQuoteForbiddenException
     * @throws ValidationException
     */
    public function create($requestBody, ?bool $returnArray = false): Quote
    {
        $this->validator->validateRequest($requestBody);
    
        $quote = $this->openApiClient->createQuote($requestBody);
        echo "<pre>".print_r($quote, true)."</pre>";
        $this->validator->validateResponse($quote);

        if (is_array($quote)) {
            return new Quote($quote);
        } else {
            throw new \UnexpectedValueException('Unexpected response type');
        }
    
    }
}
