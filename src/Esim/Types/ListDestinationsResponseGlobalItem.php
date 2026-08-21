<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class ListDestinationsResponseGlobalItem extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $slug
     */
    #[JsonProperty('slug')]
    public string $slug;

    /**
     * @var string $locationLogo
     */
    #[JsonProperty('locationLogo')]
    public string $locationLogo;

    /**
     * @var string $locationName
     */
    #[JsonProperty('locationName')]
    public string $locationName;

    /**
     * @var float $from
     */
    #[JsonProperty('from')]
    public float $from;

    /**
     * @param array{
     *   name: string,
     *   slug: string,
     *   locationLogo: string,
     *   locationName: string,
     *   from: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->slug = $values['slug'];
        $this->locationLogo = $values['locationLogo'];
        $this->locationName = $values['locationName'];
        $this->from = $values['from'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
