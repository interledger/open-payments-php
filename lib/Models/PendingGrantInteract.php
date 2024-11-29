<?php

namespace OpenPayments\Models;

class PendingGrantInteract
{
    public string $redirect;
    public string $finish;

    public function __construct(string $redirect, string $finish)
    {
        $this->redirect = $redirect;
        $this->finish = $finish;
    }
}