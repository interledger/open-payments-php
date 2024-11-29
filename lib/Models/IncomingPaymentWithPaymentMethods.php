<?php

namespace OpenPayments\Models;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod;

class IncomingPaymentWithPaymentMethods extends IncomingPaymentWithMethods
{
    /**
     * @var array<PaymentMethod>
     */
    private array $methods;

    /**
     * Constructor.
     *
     * @param array $data Associative array with payment data, including `methods`.
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        // Ensure 'methods' exists and is an array of PaymentMethod
        $this->methods = array_map(
            fn($methodData) => new IlpPaymentMethod($methodData),
            $data['methods'] ?? []
        );
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

