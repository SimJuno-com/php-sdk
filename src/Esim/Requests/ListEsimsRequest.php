<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;

class ListEsimsRequest extends JsonSerializableType
{
    /**
     * @var ?int $page
     */
    public ?int $page;

    /**
     * @var ?int $limit
     */
    public ?int $limit;

    /**
     * @param array{
     *   page?: ?int,
     *   limit?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->limit = $values['limit'] ?? null;
    }
}
