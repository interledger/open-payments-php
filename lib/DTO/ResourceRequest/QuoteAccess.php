<?php

declare(strict_types=1);

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\QuoteAccessAction;

class QuoteAccess
{
    public const string TYPE = 'quote';

    public readonly string $type;

    /**
     * @var QuoteAccessAction[] List of allowed actions
     */
    public readonly array $actions;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(array $actions)
    {
        $this->type = self::TYPE;
        foreach ($actions as $action) {
            if (! $action instanceof QuoteAccessAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'actions' => array_map(fn ($action) => $action->value, $this->actions),
        ];
    }
}
