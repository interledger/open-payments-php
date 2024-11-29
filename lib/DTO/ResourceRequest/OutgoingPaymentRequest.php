<?php

namespace OpenPayments\DTO\ResourceRequest;
use OpenPayments\Enums\OutgoingPaymentRequestAction;

class OutgoingPaymentRequest
{
    public const TYPE = 'outgoing-payment';

    public string $type = self::TYPE;
    /**
     * @var OutgoingPaymentRequestAction[] List of allowed actions
     */
    public array $actions;
    public string $identifier;
    public ?Limits $limits;
    
    /**
     * __construct
     *
     * @param OutgoingPaymentRequestAction[] $actions
     * @param mixed $identifier
     * @return void
     * @throws \InvalidArgumentException if an invalid action is provided
     */
    public function __construct(array $actions, string $identifier, ?Limits $limits = null)
    {
        foreach ($actions as $action) {
            if (!$action instanceof OutgoingPaymentRequestAction) {
                throw new \InvalidArgumentException('Invalid action provided');
            }
        }
        $this->actions = $actions;
        $this->identifier = $identifier;
        $this->limits = $limits;
    }

    /**
     * Convert the DTO to an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = [
            'type' => $this->type,
            'actions' => array_map(fn($action) => $action->value, $this->actions),
            'identifier' => $this->identifier,
        ];
        if ($this->limits !== null) {
            $array['limits'] = $this->limits->toArray();
        }
        return $array;
    }
}