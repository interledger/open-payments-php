<?php

declare(strict_types=1);

use OpenPayments\DTO\GrantInteraction;
use OpenPayments\DTO\GrantInteractionFinish;
use PHPUnit\Framework\TestCase;

class GrantInteractionTest extends TestCase
{
    public function test_to_array_handles_missing_finish(): void
    {
        $grantInteraction = new GrantInteraction(
            ['redirect' => 'https://example.com/start']
        );

        $this->assertSame(
            [
                'start' => ['redirect' => 'https://example.com/start'],
                'finish' => null,
            ],
            $grantInteraction->toArray()
        );
    }

    public function test_to_array_serializes_finish_when_present(): void
    {
        $grantInteraction = new GrantInteraction(
            ['redirect' => 'https://example.com/start'],
            new GrantInteractionFinish(
                'redirect',
                'https://example.com/finish',
                'nonce-123'
            )
        );

        $this->assertSame(
            [
                'start' => ['redirect' => 'https://example.com/start'],
                'finish' => [
                    'method' => 'redirect',
                    'uri' => 'https://example.com/finish',
                    'nonce' => 'nonce-123',
                ],
            ],
            $grantInteraction->toArray()
        );
    }
}
