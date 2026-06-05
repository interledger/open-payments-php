<?php

namespace OpenPayments\Contracts;

use OpenPayments\Models\OutgoingPayment;
use OpenPayments\Models\OutgoingPaymentGrant;
use OpenPayments\Models\OutgoingPaymentsList;
use Psr\Http\Message\ResponseInterface;

interface OutgoingPaymentRoutes
{
    /**
     * Fetches the latest state of an outgoing payment by its ID.
     *
     * @return OutgoingPayment|null
     */
    public function get(array $reqParams): OutgoingPayment;

    /**
     * Lists all outgoing payments on a wallet address.
     *
     * @return OutgoingPaymentsList|null
     */
    public function list(array $queryParams, array $listParams): OutgoingPaymentsList;

    /**
     * Creates a new outgoing payment.
     *
     * @return OutgoingPayment|ResponseInterface|null
     */
    public function create(array $params, array $outgoingPaymentRequest): OutgoingPayment;

    /**
     * Returns the spent amounts for the current outgoing payment grant
     * corresponding to the presented GNAP access token.
     * If a grant was created with an interval (recurring), the amounts returned
     * are for the current interval.
     *
     * @return OutgoingPaymentGrant
     */
    public function getGrant(array $reqParams): OutgoingPaymentGrant;
}
