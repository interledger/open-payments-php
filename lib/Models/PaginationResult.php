<?php

namespace OpenPayments\Models;

use OpenPayments\OpenApi\Generated\ResourceServer\Model\PageInfo;

class PaginationResult
{
    private PageInfo $pagination;

    /**
     * @var array<mixed> The generic result array.
     */
    private array $result;

    /**
     * Constructor.
     *
     * @param PageInfo $pagination Pagination details.
     * @param array<mixed> $result The results array.
     */
    public function __construct(PageInfo $pagination, array $result)
    {
        $this->pagination = $pagination;
        $this->result = $result;
    }

    /**
     * Get the pagination details.
     *
     * @return PageInfo
     */
    public function getPagination(): PageInfo
    {
        return $this->pagination;
    }

    /**
     * Get the results array.
     *
     * @return array<mixed>
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * Set the results array.
     *
     * @param array<mixed> $result
     */
    public function setResult(array $result): void
    {
        $this->result = $result;
    }
}