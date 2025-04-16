<?php

declare(strict_types=1);

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\IncomingPaymentRoutes;
use OpenPayments\Exceptions\CompleteIncomingPaymentForbiddenException;
use OpenPayments\Exceptions\CompleteIncomingPaymentNotFoundException;
use OpenPayments\Exceptions\CompleteIncomingPaymentUnauthorizedException;
use OpenPayments\Exceptions\CreateIncomingPaymentForbiddenException;
use OpenPayments\Exceptions\CreateIncomingPaymentUnauthorizedException;
use OpenPayments\Exceptions\GetIncomingPaymentForbiddenException;
use OpenPayments\Exceptions\GetIncomingPaymentNotFoundException;
use OpenPayments\Exceptions\GetIncomingPaymentUnauthorizedException;
use OpenPayments\Exceptions\ListIncomingPaymentsForbiddenException;
use OpenPayments\Exceptions\ListIncomingPaymentsUnauthorizedException;
use OpenPayments\Exceptions\ValidationException;
use OpenPayments\Models\IncomingPayment;
use OpenPayments\Models\IncomingPaymentsList;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;
use OpenPayments\Traits\GetIdFromUrl;
use OpenPayments\Validators\IncomingPaymentValidator;

class IncomingPaymentService implements IncomingPaymentRoutes
{
    use GetIdFromUrl;

    private ApiClient $apiClient;

    private string $baseUrl;

    private IncomingPaymentValidator $validator;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->validator = new IncomingPaymentValidator;
    }

    /**
     * Fetches the latest state of an incoming payment by its ID.
     *
     * @param  array  $reqParams  The identifier of the incoming payment.
     * @param  bool|null  $returnArray
     *
     * @throws GetIncomingPaymentUnauthorizedException
     */
    public function get(array $reqParams): IncomingPaymentWithPaymentMethods|IncomingPayment
    {
        if (! isset($reqParams['url']) || ! isset($reqParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (strpos($reqParams['url'], 'incoming-payments/') === false) {
            throw new \InvalidArgumentException('Invalid token URL');
        }
        $this->apiClient->setAccessToken($reqParams['access_token']);
        $response = $this->apiClient->request('GET', $reqParams['url']);

        if (is_array($response) && ! isset($response['error'])) {
            if (isset($response['id'])) {
                return new IncomingPaymentWithPaymentMethods($response);
            } else {
                return new IncomingPayment($response);
            }

            return new IncomingPaymentWithPaymentMethods($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new GetIncomingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new GetIncomingPaymentForbiddenException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response type '.gettype($response).' '.print_r($response, true));
        }

    }

    /**
     * Fetches the latest state of an incoming payment by its ID.
     *
     * @param  array  $reqParams  The identifier of the incoming payment.
     * @param  bool|null  $returnArray
     * @return IncomingPayment|array
     *
     * @throws GetIncomingPaymentUnauthorizedException
     * @throws GetIncomingPaymentForbiddenException
     * @throws GetIncomingPaymentNotFoundException
     */
    public function getPublic(array $reqParams): IncomingPayment
    {
        if (! isset($reqParams['url'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (strpos($reqParams['url'], 'incoming-payments/') === false) {
            throw new \InvalidArgumentException('Invalid token URL');
        }
        $response = $this->apiClient->request('GET', $reqParams['url']);

        if (is_array($response) && ! isset($response['error'])) {
            return new IncomingPayment($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new GetIncomingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new GetIncomingPaymentForbiddenException($response['message']);
            }
            if ($status === 404) {
                throw new GetIncomingPaymentNotFoundException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response type '.gettype($response).' '.print_r($response, true));
        }

    }

    /**
     * Creates a new incoming payment.
     *
     * @param  array  $data  request info.
     * @param  array  $incomingPaymentRequest  The incoming payment request.
     * @param  bool|null  $returnArray
     * @return IncomingPaymentWithPaymentMethods|array
     *
     * @throws ValidationException
     * @throws CreateIncomingPaymentUnauthorizedException
     * @throws CreateIncomingPaymentForbiddenException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function create(
        array $data,
        array $incomingPaymentRequest
    ): IncomingPaymentWithPaymentMethods {
        if (! isset($data['url']) || ! isset($data['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->validator->validateRequest($incomingPaymentRequest);
        $this->apiClient->setAccessToken($data['access_token']);
        $response = $this->apiClient->request('POST', $data['url'].'/incoming-payments', $incomingPaymentRequest);

        if (is_array($response) && ! isset($response['error'])) {
            return new IncomingPaymentWithPaymentMethods($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new CreateIncomingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new CreateIncomingPaymentForbiddenException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }
    }

    /**
     * Completes an incoming payment.
     *
     * @param  array  $params  The identifiers url and access_token of the incoming payment.
     * @return IncomingPaymentWithPaymentMethods|array
     *
     * @throws CompleteIncomingPaymentUnauthorizedException
     * @throws CompleteIncomingPaymentForbiddenException
     * @throws CompleteIncomingPaymentNotFoundException
     * @throws CompleteIncomingPaymentConflictException
     */
    public function complete(array $params): IncomingPaymentWithPaymentMethods
    {
        if (! isset($params['url']) || ! isset($params['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (strpos($params['url'], 'incoming-payments/') === false) {
            throw new \InvalidArgumentException('Invalid complete incoming payment URL');
        }
        $this->apiClient->setAccessToken($params['access_token']);
        $response = $this->apiClient->request('POST', $params['url'].'/complete');

        if (is_array($response) && ! isset($response['error'])) {
            return new IncomingPaymentWithPaymentMethods($response);
        } else {
            $status = $response['status_code'] ?? 0;

            if ($status === 401) {
                throw new CompleteIncomingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new CompleteIncomingPaymentForbiddenException($response['message']);
            }
            if ($status === 404) {
                throw new CompleteIncomingPaymentNotFoundException($response['message']);
            }

            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }

    }

    /**
     * List all incoming payments on the wallet address
     *
     * @param  array  $queryParams  {
     *
     * @var string $url The URL of the resource server.
     * @var int $access_token the access token.
     *          }
     *
     * @param  array  $listParams  {
     *
     * @var string $wallet-address URL of a wallet address hosted by a Rafiki instance.
     * @var string $cursor The cursor key to list from.
     * @var int $first The number of items to return after the cursor.
     * @var int $last The number of items to return before the cursor.
     *          }
     *
     * @return null|IncomingPaymentsList
     *
     * @throws ListIncomingPaymentsUnauthorizedException
     * @throws ListIncomingPaymentsForbiddenException
     */
    public function list(
        array $queryParams,
        array $listParams
    ): IncomingPaymentsList {
        if (! isset($queryParams['url']) || ! isset($queryParams['access_token']) || ! isset($listParams['wallet-address'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->apiClient->setAccessToken($queryParams['access_token']);
        $response = $this->apiClient->request('GET', $queryParams['url'].'/incoming-payments', $listParams);

        if (is_array($response) && ! isset($response['error'])) {
            return new IncomingPaymentsList($response);
        } else {
            $status = $response['status_code'] ?? 0;

            if ($status === 401) {
                throw new ListIncomingPaymentsUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new ListIncomingPaymentsForbiddenException($response['message']);
            }

            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }

    }
}
