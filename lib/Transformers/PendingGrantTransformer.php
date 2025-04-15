<?php

namespace OpenPayments\Transformers;

use OpenPayments\Models\PendingGrant;
use OpenPayments\Models\PendingGrantContinue;
use OpenPayments\Models\PendingGrantInteract;
use OpenPayments\Models\SimpleAccessToken;
use Psr\Http\Message\ResponseInterface;
use stdClass;

class PendingGrantTransformer
{
    public function createFromResponse(array|stdClass|ResponseInterface $response): PendingGrant
    {
        if ($response instanceof stdClass) {
            $response = json_decode(json_encode($response), true);
        }
        // Create PendingGrantInteract instance
        $interactData = $response['interact'];
        $pendingGrantInteract = new PendingGrantInteract(
            $interactData['redirect'],
            $interactData['finish']
        );

        // Create AccessToken instance for the continue field
        $continueData = $response['continue'];
        $accessToken = new SimpleAccessToken(
            $continueData['access_token']['value'],
            '', // The 'manage' field is not applicable here.
            null
        );

        // Create PendingGrantContinue instance
        $pendingGrantContinue = new PendingGrantContinue(
            $accessToken,
            $continueData['uri'],
            $continueData['wait'] ?? null
        );

        // Create and return the PendingGrant instance
        return new PendingGrant($pendingGrantInteract, $pendingGrantContinue);
    }
}
