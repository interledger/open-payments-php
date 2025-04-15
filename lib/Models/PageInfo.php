<?php

namespace OpenPayments\Models;

class PageInfo
{
    /**
     * Cursor corresponding to the first element in the result array.
     *
     * @var string
     */
    public $startCursor;

    /**
     * Cursor corresponding to the last element in the result array.
     *
     * @var string
     */
    public $endCursor;

    /**
     * Describes whether the data set has further entries.
     *
     * @var bool
     */
    public $hasNextPage;

    /**
     * Describes whether the data set has previous entries.
     *
     * @var bool
     */
    public $hasPreviousPage;

    /**
     * Cursor corresponding to the first element in the result array.
     */
    public function getStartCursor(): string
    {
        return $this->startCursor;
    }

    /**
     * Cursor corresponding to the first element in the result array.
     */
    public function setStartCursor(string $startCursor): self
    {
        $this->startCursor = $startCursor;

        return $this;
    }

    /**
     * Cursor corresponding to the last element in the result array.
     */
    public function getEndCursor(): string
    {
        return $this->endCursor;
    }

    /**
     * Cursor corresponding to the last element in the result array.
     */
    public function setEndCursor(string $endCursor): self
    {
        $this->endCursor = $endCursor;

        return $this;
    }

    /**
     * Describes whether the data set has further entries.
     */
    public function getHasNextPage(): bool
    {
        return $this->hasNextPage;
    }

    /**
     * Describes whether the data set has further entries.
     */
    public function setHasNextPage(bool $hasNextPage): self
    {
        $this->hasNextPage = $hasNextPage;

        return $this;
    }

    /**
     * Describes whether the data set has previous entries.
     */
    public function getHasPreviousPage(): bool
    {
        return $this->hasPreviousPage;
    }

    /**
     * Describes whether the data set has previous entries.
     */
    public function setHasPreviousPage(bool $hasPreviousPage): self
    {
        $this->hasPreviousPage = $hasPreviousPage;

        return $this;
    }
}
