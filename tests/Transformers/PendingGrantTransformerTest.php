<?php

declare(strict_types=1);

namespace Tests\Transformers;

use OpenPayments\Transformers\PendingGrantTransformer;
use PHPUnit\Framework\TestCase;

class PendingGrantTransformerTest extends TestCase
{
    public function test_pending_grant_response(): void
    {
        $pendingGrant = (new PendingGrantTransformer)->createFromResponse([
            'interact' => [
                'redirect' => 'https://auth.interledger-test.dev/4CF492MLVMSW9MKMXKHQ',
                'finish' => '4105340a-05eb-4290-8739-f9e2b463bfa7',
            ],
            'continue' => [
                'access_token' => ['value' => '33OMUKMKSKU80UPRY5NM'],
                'uri' => 'https://auth.interledger-test.dev/continue/4CF492MLVMSW9MKMXKHQ',
                'wait' => 30,
            ],
        ]);

        $this->assertSame('33OMUKMKSKU80UPRY5NM', $pendingGrant->continue->access_token->value);
        $this->assertSame('https://auth.interledger-test.dev/continue/4CF492MLVMSW9MKMXKHQ', $pendingGrant->continue->uri);
        $this->assertSame(30, $pendingGrant->continue->wait);
    }
}
