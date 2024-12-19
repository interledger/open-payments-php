<?php

namespace OpenPayments\Models;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod;

class IncomingPaymentWithPaymentMethods extends IncomingPaymentWithMethods
{

    /**
     * Constructor.
     *
     * @param array $data Associative array with payment data, including `methods`.
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        // Ensure 'methods' exists and is an array of PaymentMethod
        if (!isset($data['methods']) || !is_array($data['methods'])) {
            throw new \InvalidArgumentException('Missing or invalid methods');
        }
        $this->setMethods($data);
        



    }

    /**
     * Get the payment methods.
     *
     * @return array<IlpPaymentMethod>
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Add a payment method.
     *
     * @param IlpPaymentMethod $method
     */
    public function addMethod(IlpPaymentMethod $method): void
    {
        $this->methods[] = $method;
    }
}

