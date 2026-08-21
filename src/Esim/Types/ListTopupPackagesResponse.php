<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class ListTopupPackagesResponse extends JsonSerializableType
{
    /**
     * @var array<ListTopupPackagesResponsePackagesItem> $packages
     */
    #[JsonProperty('packages'), ArrayType([ListTopupPackagesResponsePackagesItem::class])]
    public array $packages;

    /**
     * @var float $total
     */
    #[JsonProperty('total')]
    public float $total;

    /**
     * @param array{
     *   packages: array<ListTopupPackagesResponsePackagesItem>,
     *   total: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->packages = $values['packages'];
        $this->total = $values['total'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
