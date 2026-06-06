<?php

declare(strict_types=1);

namespace OpenPayments\Enums;

/**
 * Error codes returned by the Open Payments Authorization Server.
 *
 * @see https://github.com/interledger/open-payments-specifications/blob/main/openapi/auth-server.yaml
 */
enum GrantErrorCode: string
{
    case InvalidClient = 'invalid_client';
    case InvalidRequest = 'invalid_request';
    case RequestDenied = 'request_denied';
    case TooFast = 'too_fast';
    case InvalidContinuation = 'invalid_continuation';
    case InvalidRotation = 'invalid_rotation';
}
