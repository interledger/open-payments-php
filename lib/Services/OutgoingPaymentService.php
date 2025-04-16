<?php

namespace OpenPayments\Services;

use OpenPayments\ApiClient;
use OpenPayments\Contracts\OutgoingPaymentRoutes;
use OpenPayments\Exceptions\BadRequestException;
use OpenPayments\Exceptions\CreateOutgoingPaymentForbiddenException;
use OpenPayments\Exceptions\CreateOutgoingPaymentUnauthorizedException;
use OpenPayments\Exceptions\GetOutgoingPaymentForbiddenException;
use OpenPayments\Exceptions\GetOutgoingPaymentNotFoundException;
use OpenPayments\Exceptions\GetOutgoingPaymentUnauthorizedException;
use OpenPayments\Exceptions\ListOutgoingPaymentsForbiddenException;
use OpenPayments\Exceptions\ListOutgoingPaymentsUnauthorizedException;
use OpenPayments\Models\OutgoingPayment;
use OpenPayments\Models\OutgoingPaymentsList;
use OpenPayments\Validators\OutgoingPaymentValidator;
use Psr\Http\Message\ResponseInterface;

class OutgoingPaymentService implements OutgoingPaymentRoutes
{
    private ApiClient $apiClient;

    private OutgoingPaymentValidator $validator;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->validator = new OutgoingPaymentValidator;
    }

    /**
     * Fetches the latest state of an outgoing payment by its ID.
     *
     * @param  string  $id  The identifier of the outgoing payment.
     * @param  array  $headerParameters  Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPayment|ResponseInterface|null
     *
     * @throws GetOutgoingPaymentUnauthorizedException
     * @throws GetOutgoingPaymentForbiddenException
     * @throws GetOutgoingPaymentNotFoundException
     */
    public function get(array $reqParams): OutgoingPayment
    {

        if (! isset($reqParams['url']) || ! isset($reqParams['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        if (strpos($reqParams['url'], 'outgoing-payments/') === false) {
            throw new \InvalidArgumentException('Invalid token URL');
        }
        $this->apiClient->setAccessToken($reqParams['access_token']);
        $response = $this->apiClient->request('GET', $reqParams['url']);

        if (is_array($response) && ! isset($response['error'])) {
            return new OutgoingPayment($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new GetOutgoingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new GetOutgoingPaymentForbiddenException($response['message']);
            }
            if ($status === 404) {
                throw new GetOutgoingPaymentNotFoundException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response type '.gettype($response).' '.print_r($response, true));
        }
    }

    /**
     * Lists all outgoing payments on a wallet address.
     *
     * @param  array  $queryParams  Query parameters for pagination and filtering.
     * @param  array  $listParams  Headers including `Signature-Input` and `Signature`.
     * @return OutgoingPaymentsList|ResponseInterface|null
     *
     * @throws ListOutgoingPaymentsUnauthorizedException
     * @throws ListOutgoingPaymentsForbiddenException
     */
    public function list(array $queryParams, array $listParams): OutgoingPaymentsList
    {

        if (! isset($queryParams['url']) || ! isset($queryParams['access_token']) || ! isset($listParams['wallet-address'])) {
            throw new \InvalidArgumentException('Missing required data');
        }

        $this->apiClient->setAccessToken($queryParams['access_token']);
        $response = $this->apiClient->request('GET', $queryParams['url'].'/outgoing-payments', $listParams);

        if (is_array($response) && ! isset($response['error'])) {
            return new OutgoingPaymentsList($response);
        } else {
            $status = $response['status_code'] ?? 0;
            if ($status === 401) {
                throw new ListOutgoingPaymentsUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new ListOutgoingPaymentsForbiddenException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }
    }

    /**
     * Creates a new outgoing payment.
     *
     * @param  array  $data  request info.
     * @param  array  $outgoingPaymentRequest  The outgoing payment request.
     * @return OutgoingPayment|array|null
     *
     * @throws CreateOutgoingPaymentUnauthorizedException
     * @throws CreateOutgoingPaymentForbiddenException
     * @throws ValidationException
     * @throws \UnexpectedValueException
     */
    public function create(array $params, array $outgoingPaymentRequest): OutgoingPayment
    {
        if (! isset($params['url']) || ! isset($params['access_token'])) {
            throw new \InvalidArgumentException('Missing required data');
        }
        $this->validator->validateRequest($outgoingPaymentRequest);
        $this->apiClient->setAccessToken($params['access_token']);
        $response = $this->apiClient->request('POST', $params['url'].'/outgoing-payments', $outgoingPaymentRequest);

        if (is_array($response) && ! isset($response['error'])) {
            return new OutgoingPayment($response);
        } else {
            $status = $response['status_code'] ?? 0;

            if ($status === 400) {
                throw new BadRequestException($response['message']);
            }
            if ($status === 401) {
                throw new CreateOutgoingPaymentUnauthorizedException($response['message']);
            }
            if ($status === 403) {
                throw new CreateOutgoingPaymentForbiddenException($response['message']);
            }
            throw new \UnexpectedValueException('Unexpected response '.print_r($response, true));
        }
    }
}
