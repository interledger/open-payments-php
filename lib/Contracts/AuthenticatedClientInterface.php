<?php

namespace OpenPayments\Contracts;

interface AuthenticatedClientInterface
{
    public function walletAddress(): WalletAddressRoutes;

    public function grant(string $authServer): GrantRoutes;

    public function quote(string $resourceServer, string $accessToken): QuoteRoutes;

    public function incomingPayment(string $resourceServer, string $accessToken): IncomingPaymentRoutes;

    //public function outgoingPayment(): OutgoingPaymentRoutes;

    //public function token(): TokenRoutes;
}
