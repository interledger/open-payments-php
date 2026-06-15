<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class JsonWebKeySet
{
    public readonly array $keys;

    public function __construct(array $data)
    {
        $this->keys = array_map(fn ($key) => new JsonWebKey($key), $data['keys'] ?? []);
    }

    public function toArray(): array
    {
        return ['keys' => array_map(fn ($key) => $key->toArray(), $this->keys)];
    }
}
