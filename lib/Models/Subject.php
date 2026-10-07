<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class Subject
{
    /** @var SubjectId[] */
    public readonly array $sub_ids;

    /**
     * @param  SubjectId[]  $sub_ids
     */
    public function __construct(array $sub_ids)
    {
        $this->sub_ids = $sub_ids;
    }

    /**
     * Convert the model to an associative array.
     */
    public function toArray(): array
    {
        return [
            'sub_ids' => array_map(fn (SubjectId $subId) => $subId->toArray(), $this->sub_ids),
        ];
    }
}
