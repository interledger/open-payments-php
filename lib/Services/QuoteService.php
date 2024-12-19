<?php

namespace OpenPayments\Services;


use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;

use OpenPayments\Contracts\QuoteRoutes;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote;
use OpenPayments\OpenApi\Generated\ResourceServer\Exception\{
    GetQuoteUnauthorizedException,
    GetQuoteForbiddenException,
    GetQuoteNotFoundException,
    CreateQuoteBadRequestException,
    CreateQuoteUnauthorizedException,
    CreateQuoteForbiddenException
};
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use Psr\Http\Message\ResponseInterface;

class QuoteService implements QuoteRoutes
{
  private OpenApiResourceServerClient $openApiClient;
  private Validator $validator;

    public function __construct(OpenApiResourceServerClient $httpClient)
    {
        $this->openApiClient = $httpClient;

        $this->validator = new Validator();
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
     */
    public function get(string $id, array $headerParameters): Quote
    {
        $response = $this->openApiClient->getQuote($id, $headerParameters);
        if (is_array($response)) {
            // Assuming the array contains the necessary data to create a Quote object
            return new Quote($response);
        } elseif ($response instanceof Quote) {
            return $response;
        } elseif ($response instanceof ResponseInterface) {
            // Handle the response, e.g., decode JSON body
            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);
            return new Quote($data);
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
     */
    public function create($requestBody, ?string $accessToken = null): Quote
    {
        // $data = json_decode($requestBody);
        // $schema = json_decode($jsonSchema);
        
        //$this->validator->validate($data, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);
        

    
        $response = $this->openApiClient->createQuote($requestBody);

        if (is_array($response)) {
            // Assuming the array contains the necessary data to create a Quote object
            return new Quote($response);
        } elseif ($response instanceof Quote) {
            return $response;
        } elseif ($response instanceof ResponseInterface) {
            // Handle the response, e.g., decode JSON body
            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);
            return new Quote($data);
        } else {
            throw new \UnexpectedValueException('Unexpected response type');
        }
    
    }
}
