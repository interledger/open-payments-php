<?php

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\IncomingPaymentRequestAction;

class IncomingPaymentRequest
{
    public const TYPE = 'incoming-payment';

    public string $type = self::TYPE;

    /**
     * @var IncomingPaymentRequestAction[] List of allowed actions
     */
    public array $actions;

    public ?string $identifier;

    /**
     * __construct
     *
     * @param  IncomingPaymentRequestAction[]  $actions
     * @param  mixed  $identifier
     * @return void
     *
     * @throws \InvalidArgumentException if an invalid action is provided
     */
    public function __construct(array $actions, ?string $identifier = null)
    {
        foreach ($actions as $action) {
            if (! $action instanceof IncomingPaymentRequestAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
        if ($identifier) {
            $this->identifier = $identifier;
        }
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        $array = [
            'type' => $this->type,
            'actions' => array_map(fn ($action) => $action->value, $this->actions),
        ];
        if ($this->identifier !== null) {
            $array['identifier'] = $this->identifier;
        }

        return $array;
    }
}
