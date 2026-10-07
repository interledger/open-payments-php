<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class SubjectId
{
    public readonly string $id;

    public readonly string $format;

    public function __construct(string $id, string $format)
    {
        $this->id = $id;
        $this->format = $format;
    }

    /**
     * Convert the model to an associative array.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'format' => $this->format,
        ];
    }
}
