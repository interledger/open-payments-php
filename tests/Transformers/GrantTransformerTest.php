<?php

declare(strict_types=1);

namespace Tests\Transformers;

use OpenPayments\Models\AccessToken;
use OpenPayments\Models\SimpleAccessToken;
use OpenPayments\Transformers\GrantTransformer;
use PHPUnit\Framework\TestCase;

class GrantTransformerTest extends TestCase
{
    private const CONTINUE = [
        'access_token' => ['value' => '33OMUKMKSKU80UPRY5NM'],
        'uri' => 'https://auth.interledger-test.dev/continue/4CF492MLVMSW9MKMXKHQ',
        'wait' => 30,
    ];

    private const SUBJECT = [
        'sub_ids' => [
            ['id' => 'https://ilp.interledger-test.dev/alice', 'format' => 'uri'],
        ],
    ];

    private const ACCESS_TOKEN = [
        'value' => 'OS9M2PMHKUR64TB8N6BW7OZB8CDFONP219RP1LT0',
        'manage' => 'https://auth.interledger-test.dev/token/dd17a202-9982-4ed9-ae31-564947fb6379',
        'expires_in' => 3600,
        'access' => [
            [
                'type' => 'incoming-payment',
                'actions' => ['create', 'read'],
                'identifier' => 'https://ilp.interledger-test.dev/alice',
            ],
        ],
    ];

    public function test_subject_only_response(): void
    {
        $grant = (new GrantTransformer)->createFromResponse([
            'subject' => self::SUBJECT,
            'continue' => self::CONTINUE,
        ]);

        $this->assertNull($grant->access_token);
        $this->assertNotNull($grant->subject);
        $this->assertCount(1, $grant->subject->sub_ids);
        $this->assertSame('https://ilp.interledger-test.dev/alice', $grant->subject->sub_ids[0]->id);
        $this->assertSame('uri', $grant->subject->sub_ids[0]->format);
        $this->assertSame(self::SUBJECT, $grant->subject->toArray());
        $this->assertInstanceOf(SimpleAccessToken::class, $grant->continue->access_token);
        $this->assertSame('33OMUKMKSKU80UPRY5NM', $grant->continue->access_token->value);
        $this->assertSame(self::CONTINUE['uri'], $grant->continue->uri);
        $this->assertSame(30, $grant->continue->wait);
    }

    public function test_access_token_response(): void
    {
        $grant = (new GrantTransformer)->createFromResponse([
            'access_token' => self::ACCESS_TOKEN,
            'continue' => self::CONTINUE,
        ]);

        $this->assertNull($grant->subject);
        $this->assertInstanceOf(AccessToken::class, $grant->access_token);
        $this->assertSame(self::ACCESS_TOKEN['value'], $grant->access_token->value);
        $this->assertSame(self::ACCESS_TOKEN['manage'], $grant->access_token->manage);
        $this->assertInstanceOf(AccessToken::class, $grant->continue->access_token);
        $this->assertSame('33OMUKMKSKU80UPRY5NM', $grant->continue->access_token->value);
    }

    public function test_access_token_and_subject_response(): void
    {
        $grant = (new GrantTransformer)->createFromResponse([
            'access_token' => self::ACCESS_TOKEN,
            'subject' => self::SUBJECT,
            'continue' => self::CONTINUE,
        ]);

        $this->assertNotNull($grant->access_token);
        $this->assertNotNull($grant->subject);
        $this->assertSame('https://ilp.interledger-test.dev/alice', $grant->subject->sub_ids[0]->id);
    }

    public function test_pending_continue_response_throws(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        (new GrantTransformer)->createFromResponse(['continue' => self::CONTINUE]);
    }

    public function test_response_without_continue_throws(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        (new GrantTransformer)->createFromResponse(['message' => 'No content returned', 'status_code' => 204]);
    }
}
