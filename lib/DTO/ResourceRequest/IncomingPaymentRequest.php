<?php

declare(strict_types=1);

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\IncomingPaymentRequestAction;

class IncomingPaymentRequest
{
    public const string TYPE = 'incoming-payment';

    public readonly string $type;

    /**
     * @var IncomingPaymentRequestAction[] List of allowed actions
     */
    public readonly array $actions;

    public readonly ?string $identifier;

    /**
     * @param  IncomingPaymentRequestAction[]  $actions
     *
     * @throws \InvalidArgumentException if an invalid action is provided
     */
    public function __construct(array $actions, ?string $identifier = null)
    {
        $this->type = self::TYPE;
        foreach ($actions as $action) {
            if (! $action instanceof IncomingPaymentRequestAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
        $this->identifier = $identifier;
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
