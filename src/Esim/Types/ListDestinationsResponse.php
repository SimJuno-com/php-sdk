<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class ListDestinationsResponse extends JsonSerializableType
{
    /**
     * @var array<ListDestinationsResponseCountryItem> $country
     */
    #[JsonProperty('Country'), ArrayType([ListDestinationsResponseCountryItem::class])]
    public array $country;

    /**
     * @var array<ListDestinationsResponseRegionItem> $region
     */
    #[JsonProperty('Region'), ArrayType([ListDestinationsResponseRegionItem::class])]
    public array $region;

    /**
     * @var array<ListDestinationsResponseGlobalItem> $global
     */
    #[JsonProperty('Global'), ArrayType([ListDestinationsResponseGlobalItem::class])]
    public array $global;

    /**
     * @param array{
     *   country: array<ListDestinationsResponseCountryItem>,
     *   region: array<ListDestinationsResponseRegionItem>,
     *   global: array<ListDestinationsResponseGlobalItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->country = $values['country'];
        $this->region = $values['region'];
        $this->global = $values['global'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
