<?php

namespace OpenPayments\DTO;

class GrantInteraction
{
    public array $start; // Only contains "redirect" values
    public ?GrantInteractionFinish $finish;

    public function __construct(array $start, ?GrantInteractionFinish $finish = null)
    {
        $this->start = $start;
        $this->finish = $finish;
    }

    /**
     * Convert the DTO to an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'start' => $this->start,
            'finish' => $this->finish->toArray(),
        ];
    }
}
