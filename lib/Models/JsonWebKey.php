<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class JsonWebKey
{
    public readonly string $kid;

    public readonly string $alg;

    public readonly ?string $use;

    public readonly ?string $kty;

    public readonly ?string $crv;

    public readonly ?string $x;

    public function __construct(array $data)
    {
        if (! isset($data['kid'])) {
            throw new \InvalidArgumentException('Missing required field: kid');
        }
        if (! isset($data['alg'])) {
            throw new \InvalidArgumentException('Missing required field: alg');
        }
        $this->kid = $data['kid'];
        $this->alg = $data['alg'];
        $this->use = $data['use'] ?? null;
        $this->kty = $data['kty'] ?? null;
        $this->crv = $data['crv'] ?? null;
        $this->x = $data['x'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'kid' => $this->kid,
            'alg' => $this->alg,
            'use' => $this->use,
            'kty' => $this->kty,
            'crv' => $this->crv,
            'x' => $this->x,
        ], fn ($value) => $value !== null);
    }
}
