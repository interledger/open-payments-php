<?php

namespace OpenPayments\Transformers;

use Psr\Http\Message\ResponseInterface;
use OpenPayments\Models\Grant;
use OpenPayments\Models\AccessToken;
use OpenPayments\Models\IncomingPaymentAccess;
use OpenPayments\Models\OutgoingPaymentAccess;
use OpenPayments\Models\QuoteAccess;
use OpenPayments\Models\GrantContinue;
use stdClass;

//use stdClass;

class GrantTransformer
{
    public static function createGrantFromResponse(array | stdClass | ResponseInterface $response): Grant
    {
        if( $response instanceof stdClass || $response instanceof ResponseInterface) {
            $response = json_decode(json_encode($response), true);
        }
        $accessTokenData = $response['access_token'];
        
        $accessData = $accessTokenData['access'][0];
       
        // Determine which access type we are dealing with and create the appropriate object.
        switch ($accessData['type']) {
            case 'incoming-payment':
                $accessObject = new IncomingPaymentAccess(
                    $accessData['type'],
                    $accessData['actions'],
                    $accessData['identifier'] ?? null
                );
                break;
            case 'outgoing-payment':
                $accessObject = new OutgoingPaymentAccess(
                    $accessData['type'],
                    $accessData['actions'],
                    $accessData['identifier'],
                    $accessData['limits'] ?? null
                );
                break;
            case 'quote':
                $accessObject = new QuoteAccess(
                    $accessData['type'],
                    $accessData['actions']
                );
                break;
            default:
                throw new \InvalidArgumentException("Unknown access type: {$accessData['type']}");
        }

        // Create AccessToken instance
        $accessToken = new AccessToken(
            $accessTokenData['value'],
            $accessTokenData['manage'],
            $accessObject,
            $accessTokenData['expires_in'] ?? null
        );

        // Create GrantContinue instance
        $continueData = $response['continue'];
        $continueAccessToken = new AccessToken(
            $continueData['access_token']['value'],
            '', // The 'manage' field is not applicable here.
            $accessObject // This can be adjusted if different
        );

        $grantContinue = new GrantContinue(
            $continueAccessToken,
            $continueData['uri'],
            $continueData['wait'] ?? null
        );

        // Return the complete Grant instance
        return new Grant($accessToken, $grantContinue);
    }
}