<?php

declare(strict_types=1);

namespace OpenPayments\DTO\ResourceRequest;

use OpenPayments\Enums\OutgoingPaymentAccessAction;

class OutgoingPaymentAccess
{
    public const string TYPE = 'outgoing-payment';

    public readonly string $type;

    /**
     * @var OutgoingPaymentAccessAction[] List of allowed actions
     */
    public readonly array $actions;

    public readonly string $identifier;

    public readonly ?Limits $limits;

    /**
     * __construct
     *
     * @param  OutgoingPaymentAccessAction[]  $actions
     * @param @param string $identifier
     * @return void
     *
     * @throws \InvalidArgumentException if an invalid action is provided
     */
    public function __construct(array $actions, string $identifier, ?Limits $limits = null)
    {
        $this->type = self::TYPE;
        foreach ($actions as $action) {
            if (! $action instanceof OutgoingPaymentAccessAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
        $this->identifier = $identifier;
        $this->limits = $limits;
    }

    /**
     * Convert the DTO to an associative array.
     */
    public function toArray(): array
    {
        $array = [
            'type' => $this->type,
            'actions' => array_map(fn ($action) => $action->value, $this->actions),
            'identifier' => $this->identifier,
        ];
        if ($this->limits !== null) {
            $array['limits'] = $this->limits->toArray();
        }

        return $array;
    }
}
