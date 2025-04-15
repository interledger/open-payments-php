<?php

namespace OpenPayments\Models;

class JsonWebKey
{
    public string $kid;

    public string $alg;

    public string $use;

    public string $kty;

    public string $crv;

    public string $x;

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
        if (isset($data['use'])) {
            $this->use = $data['use'];
        }
        if (isset($data['kty'])) {
            $this->kty = $data['kty'];
        }
        if (isset($data['crv'])) {
            $this->crv = $data['crv'];
        }
        if (isset($data['x'])) {
            $this->x = $data['x'];
        }
    }

    public function toArray(): array
    {
        $return = [
            'kid' => $this->kid,
            'alg' => $this->alg,
            'use' => $this->use,
            'kty' => $this->kty,
            'crv' => $this->crv,
            'x' => $this->x,
        ];

        return array_filter($return, function ($value) {
            return $value !== null;
        });
    }
}
