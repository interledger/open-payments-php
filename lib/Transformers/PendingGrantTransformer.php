<?php

namespace OpenPayments\Transformers;

use Psr\Http\Message\ResponseInterface;
use OpenPayments\Models\PendingGrant;
use OpenPayments\Models\PendingGrantInteract;
use OpenPayments\Models\PendingGrantContinue;
use OpenPayments\Models\SimpleAccessToken;
use stdClass;

class PendingGrantTransformer
{
    public static function createPendingGrantFromResponse(stdClass | ResponseInterface $response): PendingGrant
    {
        // Create PendingGrantInteract instance
        $interactData = $response->interact;
        $pendingGrantInteract = new PendingGrantInteract(
            $interactData->redirect,
            $interactData->finish
        );

        // Create AccessToken instance for the continue field
        $continueData = $response->continue;
        $accessToken = new SimpleAccessToken(
            $continueData->access_token->value,
            '', // The 'manage' field is not applicable here.
            null
        );

        // Create PendingGrantContinue instance
        $pendingGrantContinue = new PendingGrantContinue(
            $accessToken,
            $continueData->uri,
            $continueData->wait ?? null
        );

        // Create and return the PendingGrant instance
        return new PendingGrant($pendingGrantInteract, $pendingGrantContinue);
    }
}