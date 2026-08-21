<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class ListTopupPackagesResponsePackagesItemLocationNetworkListItemOperatorListItem extends JsonSerializableType
{
    /**
     * @var string $operatorName
     */
    #[JsonProperty('operatorName')]
    public string $operatorName;

    /**
     * @var string $networkType
     */
    #[JsonProperty('networkType')]
    public string $networkType;

    /**
     * @param array{
     *   operatorName: string,
     *   networkType: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->operatorName = $values['operatorName'];
        $this->networkType = $values['networkType'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
