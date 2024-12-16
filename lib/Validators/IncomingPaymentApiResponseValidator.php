<?php

namespace OpenPayments\Validators;


use OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment;
use OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment;
use OpenPayments\Models\IncomingPaymentWithPaymentMethods;
use OpenPayments\Models\PaginationResult;

use OpenPayments\Exceptions\ValidationException;

class IncomingPaymentApiResponseValidator
{

  public static function validateIncomingPayment(array $payment): bool
  {
      if (isset($payment['incomingAmount'], $payment['receivedAmount'])) {
          $incomingAmount = $payment['incomingAmount'];
          $receivedAmount = $payment['receivedAmount'];

          if (
              $incomingAmount['assetCode'] !== $receivedAmount['assetCode'] ||
              $incomingAmount['assetScale'] !== $receivedAmount['assetScale']
          ) {
              return false;
          }
      }
      return true;
  }

  public static function validateCreatedIncomingPayment(array $payment): bool
  {
      if ($payment['receivedAmount']['value'] !== '0') {
          throw new ValidationException('Received amount must be zero.');
      }

      if ($payment['completed'] === true) {
          throw new ValidationException('Cannot create a completed payment.');
      }

      return self::validateIncomingPayment($payment);
  }

  public static function validateCompletedIncomingPayment(array $payment): IncomingPayment
  {
      if ($payment['completed'] !== true) {
          throw new ValidationException('Payment could not be completed.');
      }

      return new IncomingPayment($payment);
  }
}