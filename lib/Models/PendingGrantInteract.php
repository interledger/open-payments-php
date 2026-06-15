<?php

declare(strict_types=1);

namespace OpenPayments\Models;

class PendingGrantInteract
{
    public readonly string $redirect;

    public readonly string $finish;

    public function __construct(string $redirect, string $finish)
    {
        $this->redirect = $redirect;
        $this->finish = $finish;
    }
}
