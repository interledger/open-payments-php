<?php

namespace OpenPayments\Traits;

trait GetIdFromUrl
{
    /**
     * Get the ID from a URL.
     */
    public function getIdFromUrl(string $url): string
    {
        $parts = explode('/', $url);

        return end($parts);
    }
}
