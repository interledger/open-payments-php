<?php 
namespace OpenPayments\Contracts;

interface UnauthenticatedClientInterface
{
    public function walletAddress(): WalletAddressRoutes;

    public function incomingPayment(): UnauthenticatedIncomingPaymentRoutes;
}