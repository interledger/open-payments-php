<?php

declare(strict_types=1);

namespace OpenPayments\DTO;

class PendingGrantInteraction
{
    public readonly string $redirect;

    public readonly string $finish;

    /**
     * @param  string  $redirect  The URI to direct the end user to.
     * @param  string  $finish  Unique key to secure the callback.
     */
    public function __construct(string $redirect, string $finish)
    {
        $this->redirect = $redirect;
        $this->finish = $finish;
    }
}
