<?php

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\QuoteRoutes;
use OpenPayments\Exceptions\CreateQuoteBadRequestException;
use OpenPayments\Exceptions\CreateQuoteForbiddenException;
use OpenPayments\Exceptions\CreateQuoteUnauthorizedException;
use OpenPayments\Exceptions\GetQuoteForbiddenException;
use OpenPayments\Exceptions\GetQuoteNotFoundException;
use OpenPayments\Exceptions\GetQuoteUnauthorizedException;
use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Models\Quote;
use OpenPayments\Traits\GetIdFromUrl;
use OpenPayments\Validators\QuoteValidator;
use Psr\Http\Message\ResponseInterface;

class QuoteService implements QuoteRoutes
{
    use GetIdFromUrl;

    private ApiClient $apiClient;

    private string $baseUrl;

    private QuoteValidator $validator;

    public function __construct(
        ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->validator = new QuoteValidator;
    }

    /**
     * Fetches the latest state of a quote by its ID.
     *
     * @param  string  $id  The identifier of the quote.
     * @param  array  $headerParameters  The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     *
     * @throws GetQuoteUnauthorizedException
     * @throws GetQuoteForbiddenException
     * @throws GetQuoteNotFoundException
     */
    public function get(array $reqParams): Quote
    {
        if (! isset($reqParams['url']) || ! isset($reqParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }

        $this->apiClient->setAccessToken($reqParams['access_token']);

        $response = $this->apiClient->request('GET', $reqParams['url']);

        if (is_array($response) && ! isset($response['error'])) {
            return new Quote($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new GetQuoteUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new GetQuoteForbiddenException($response['message']);
            }
            if ($status === 404) {
                throw new GetQuoteNotFoundException($response['message']);
            }
            throw new \UnexpectedValueException($response['message']);
        }
    }

    /**
     * Creates a new quote.
     *
     * @param  mixed  $requestBody  The body of the request for creating a quote.
     * @param  array  $headerParameters  The header parameters including `Signature-Input` and `Signature`.
     * @return Quote|ResponseInterface|null
     *
     * @throws CreateQuoteBadRequestException
     * @throws CreateQuoteUnauthorizedException
     * @throws CreateQuoteForbiddenException
     * @throws ValidationException
     */
    public function create(array $reqParams, array $quoteRequest): Quote
    {

        if (! isset($reqParams['url']) || ! isset($reqParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->validator->validateRequest($quoteRequest);
        $this->apiClient->setAccessToken($reqParams['access_token']);
        $response = $this->apiClient->request('POST', $reqParams['url'].'/quotes', $quoteRequest);

        if (is_array($response) && ! isset($response['error'])) {
            return new Quote($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 400) {
                throw new CreateQuoteBadRequestException($response['message']);
            }
            if ($status === 401) {
                throw new CreateQuoteUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new CreateQuoteForbiddenException($response['message']);
            }
            throw new \UnexpectedValueException($response['message']);
        }

    }
}
