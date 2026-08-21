<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class ListTopupPackagesResponsePackagesItemLocationNetworkListItem extends JsonSerializableType
{
    /**
     * @var string $locationName
     */
    #[JsonProperty('locationName')]
    public string $locationName;

    /**
     * @var string $locationLogo
     */
    #[JsonProperty('locationLogo')]
    public string $locationLogo;

    /**
     * @var ?string $locationCode
     */
    #[JsonProperty('locationCode')]
    public ?string $locationCode;

    /**
     * @var ?array<ListTopupPackagesResponsePackagesItemLocationNetworkListItemOperatorListItem> $operatorList
     */
    #[JsonProperty('operatorList'), ArrayType([ListTopupPackagesResponsePackagesItemLocationNetworkListItemOperatorListItem::class])]
    public ?array $operatorList;

    /**
     * @param array{
     *   locationName: string,
     *   locationLogo: string,
     *   locationCode?: ?string,
     *   operatorList?: ?array<ListTopupPackagesResponsePackagesItemLocationNetworkListItemOperatorListItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->locationName = $values['locationName'];
        $this->locationLogo = $values['locationLogo'];
        $this->locationCode = $values['locationCode'] ?? null;
        $this->operatorList = $values['operatorList'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
