<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class OrderEsimRequestOrderListItem extends JsonSerializableType
{
    /**
     * @var string $slug
     */
    #[JsonProperty('slug')]
    public string $slug;

    /**
     * @var int $count
     */
    #[JsonProperty('count')]
    public int $count;

    /**
     * @param array{
     *   slug: string,
     *   count: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->slug = $values['slug'];
        $this->count = $values['count'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
