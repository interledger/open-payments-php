<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Model;

class PageInfo
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Cursor corresponding to the first element in the result array.
     *
     * @var string
     */
    protected $startCursor;
    /**
     * Cursor corresponding to the last element in the result array.
     *
     * @var string
     */
    protected $endCursor;
    /**
     * Describes whether the data set has further entries.
     *
     * @var bool
     */
    protected $hasNextPage;
    /**
     * Describes whether the data set has previous entries.
     *
     * @var bool
     */
    protected $hasPreviousPage;
    /**
     * Cursor corresponding to the first element in the result array.
     *
     * @return string
     */
    public function getStartCursor(): string
    {
        return $this->startCursor;
    }
    /**
     * Cursor corresponding to the first element in the result array.
     *
     * @param string $startCursor
     *
     * @return self
     */
    public function setStartCursor(string $startCursor): self
    {
        $this->initialized['startCursor'] = true;
        $this->startCursor = $startCursor;
        return $this;
    }
    /**
     * Cursor corresponding to the last element in the result array.
     *
     * @return string
     */
    public function getEndCursor(): string
    {
        return $this->endCursor;
    }
    /**
     * Cursor corresponding to the last element in the result array.
     *
     * @param string $endCursor
     *
     * @return self
     */
    public function setEndCursor(string $endCursor): self
    {
        $this->initialized['endCursor'] = true;
        $this->endCursor = $endCursor;
        return $this;
    }
    /**
     * Describes whether the data set has further entries.
     *
     * @return bool
     */
    public function getHasNextPage(): bool
    {
        return $this->hasNextPage;
    }
    /**
     * Describes whether the data set has further entries.
     *
     * @param bool $hasNextPage
     *
     * @return self
     */
    public function setHasNextPage(bool $hasNextPage): self
    {
        $this->initialized['hasNextPage'] = true;
        $this->hasNextPage = $hasNextPage;
        return $this;
    }
    /**
     * Describes whether the data set has previous entries.
     *
     * @return bool
     */
    public function getHasPreviousPage(): bool
    {
        return $this->hasPreviousPage;
    }
    /**
     * Describes whether the data set has previous entries.
     *
     * @param bool $hasPreviousPage
     *
     * @return self
     */
    public function setHasPreviousPage(bool $hasPreviousPage): self
    {
        $this->initialized['hasPreviousPage'] = true;
        $this->hasPreviousPage = $hasPreviousPage;
        return $this;
    }
}