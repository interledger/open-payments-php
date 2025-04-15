<?php

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\IncomingPaymentAccessAction;

class IncomingPaymentAccess
{
    public const TYPE = 'incoming-payment';

    public string $type = self::TYPE;

    /**
     * @var IncomingPaymentAccessAction[] List of allowed actions
     */
    public array $actions;

    public ?string $identifier;

    /**
     * __construct
     *
     * @param  IncomingPaymentAccessAction[]  $actions
     * @param  mixed  $identifier
     * @return void
     *
     * @throws \InvalidArgumentException if an invalid action is provided
     */
    public function __construct(array $actions, ?string $identifier = null)
    {
        foreach ($actions as $action) {
            if (! $action instanceof IncomingPaymentAccessAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
        $this->identifier = $identifier;
    }

    /**
     * Get the list of actions as enum objects
     *
     * @return IncomingPaymentAccessAction[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'actions' => array_map(fn ($action) => $action->value, $this->actions),
            'identifier' => $this->identifier,
        ];
    }
}
