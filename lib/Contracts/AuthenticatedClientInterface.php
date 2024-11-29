<?php

namespace OpenPayments\Contracts;

interface AuthenticatedClientInterface
{
    public function walletAddress(): WalletAddressRoutes;

    public function grant(string $authServer): GrantRoutes;

    //public function quote(): QuoteRoutes;

    public function incomingPayment(): IncomingPaymentRoutes;

    //public function outgoingPayment(): OutgoingPaymentRoutes;

    //public function token(): TokenRoutes;

    //public function incomingPayment(): IncomingPaymentRoutes;
}
