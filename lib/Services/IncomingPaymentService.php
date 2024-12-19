<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\Contracts\IncomingPaymentRoutes;


use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;
use OpenPayments\Models\PaginationResult;

// use Psr\Log\LoggerInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use OpenPayments\OpenApi\Generated\ResourceServer\Client as OpenApiResourceServerClient;
use OpenPayments\Validators\IncomingPaymentApiResponseValidator as ApiResponseValidator;
use OpenPayments\Exceptions\ValidationException;

class IncomingPaymentService implements IncomingPaymentRoutes
{
    private OpenApiResourceServerClient $openApiClient;
    // private LoggerInterface $logger;

    public function __construct(
        OpenApiResourceServerClient $openApiClient
    ) {
        $this->openApiClient = $openApiClient;
    }

    public function get(string $url, ?string $accessToken = null): IncomingPaymentWithPaymentMethods
    {
        try {
            $paymentUrl = $args->url;
            $response = $this->openApiClient->getIncomingPayment();
            $response = $this->httpClient->get($url, $this->getHeaders($accessToken));
            $payment = json_decode($response->getBody()->getContents(), true);

            if (!ApiResponseValidator::validateIncomingPayment($payment)) {
                throw new \Exception("Incoming amount does not match received amount.'");
            }
            return new IncomingPaymentWithPaymentMethods($payment);
        } catch (RequestException $e) {
            $this->handleValidationError('GET', $url, $e);
        }
    }

    public function getPublic(string $url): PublicIncomingPayment
    {
        try {
            $response = $this->openApiClient->getIncomingPayment($url);
            // $data = json_decode($response->getBody()->getContents(), true);

            // return new PublicIncomingPayment($data); // Assuming PublicIncomingPayment has a constructor for validation.
            return new IncomingPayment($response, 200);

        } catch (RequestException $e) {
            $this->handleValidationError('GET', $url, $e);
        }
    }

    public function create(
        string $walletAddressUrl,
        array $createArgs,
        ?string $accessToken = null
    ): IncomingPaymentWithMethods {
        try {
            $amount = new IncomingPaymentIncomingAmount($createArgs);

            $createIPArgs = new IncomingPaymentsPostBody();
            $createIPArgs->setWalletAddress($walletAddressUrl);
            $createIPArgs->setIncomingAmount($amount);
            $expiresAt = (new \DateTime())
                ->add(new \DateInterval('PT10M')); // Add 10 minutes

            $createIPArgs->setExpiresAt($expiresAt);
            $payment = $this->openApiClient->createIncomingPayment($createIPArgs);

            
            if (!ApiResponseValidator::validateCreatedIncomingPayment($payment)) {
                throw new ValidationException("create Incoming Payment response validation failed");
            }
            return new IncomingPaymentWithMethods($payment);
        } catch (RequestException $e) {
            $this->handleValidationError('POST', 'RequestException ' , $e);
        }catch (ValidationException $e) {
            $this->handleValidationError('POST', 'ValidationException', $e);
        }
    }

    public function complete(string $url, ?string $accessToken = null): IncomingPayment
    {
        try {
            //CompleteIncomingPayment
            $response = $this->openApiClient->completeIncomingPayment($url . '/complete', $this->getHeaders($accessToken));
            $data = json_decode($response->getBody()->getContents(), true);

            return $this->validateCompletedIncomingPayment($data);
        } catch (RequestException $e) {
            $this->handleValidationError('POST', $url, $e);
        }
    }

    public function list(
        string $url,
        ?string $accessToken = null,
        ?array $pagination = null
    ): PaginationResult {
        try {
            $queryParams = $pagination ?? [];
            $response = $this->httpClient->get($url, [
                'query' => $queryParams,
                'headers' => $this->getHeaders($accessToken),
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            return new PaginationResult($data);
        } catch (RequestException $e) {
            $this->handleValidationError('GET', $url, $e);
        }
    }


    private function getHeaders(?string $accessToken): array
    {
        return $accessToken ? ['Authorization' => "GNAP $accessToken"] : [];
    }

    private function handleValidationError(string $method, string $url, ValidationException | RequestException $exception): void
    {
        // $this->logger->error("Error during $method request to $url", [
        //     'message' => $exception->getMessage(),
        //     'code' => $exception->getCode(),
        // ]);

        throw $exception;
    }
}
