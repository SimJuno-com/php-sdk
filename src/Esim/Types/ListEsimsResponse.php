<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class ListEsimsResponse extends JsonSerializableType
{
    /**
     * @var array<ListEsimsResponseEsimsItem> $esims
     */
    #[JsonProperty('esims'), ArrayType([ListEsimsResponseEsimsItem::class])]
    public array $esims;

    /**
     * @var ListEsimsResponsePagination $pagination
     */
    #[JsonProperty('pagination')]
    public ListEsimsResponsePagination $pagination;

    /**
     * @param array{
     *   esims: array<ListEsimsResponseEsimsItem>,
     *   pagination: ListEsimsResponsePagination,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->esims = $values['esims'];
        $this->pagination = $values['pagination'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
