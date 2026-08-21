<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Esim\Types\ListDestinationsRequestSortBy;

class ListDestinationsRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<ListDestinationsRequestSortBy> $sortBy
     */
    public ?string $sortBy;

    /**
     * @param array{
     *   sortBy?: ?value-of<ListDestinationsRequestSortBy>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sortBy = $values['sortBy'] ?? null;
    }
}
