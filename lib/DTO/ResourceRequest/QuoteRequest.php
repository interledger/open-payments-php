<?php

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\QuoteRequestAction;

class QuoteRequest
{
    public const TYPE = 'quote';

    public string $type = self::TYPE;

    /**
     * @var QuoteRequestAction[] List of allowed actions
     */
    public array $actions;

    /**
     * __construct
     *
     * @param  mixed  $actions
     * @return void
     */
    public function __construct(array $actions)
    {
        foreach ($actions as $action) {
            if (! $action instanceof QuoteRequestAction) {
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
