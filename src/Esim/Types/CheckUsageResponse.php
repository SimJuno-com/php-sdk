<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class CheckUsageResponse extends JsonSerializableType
{
    /**
     * @var float $dataUsage
     */
    #[JsonProperty('dataUsage')]
    public float $dataUsage;

    /**
     * @var float $totalData
     */
    #[JsonProperty('totalData')]
    public float $totalData;

    /**
     * @var ?string $lastDataUsageUpdateTime
     */
    #[JsonProperty('lastDataUsageUpdateTime')]
    public ?string $lastDataUsageUpdateTime;

    /**
     * @var ?string $esimStatus
     */
    #[JsonProperty('esimStatus')]
    public ?string $esimStatus;

    /**
     * @param array{
     *   dataUsage: float,
     *   totalData: float,
     *   lastDataUsageUpdateTime?: ?string,
     *   esimStatus?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->dataUsage = $values['dataUsage'];
        $this->totalData = $values['totalData'];
        $this->lastDataUsageUpdateTime = $values['lastDataUsageUpdateTime'] ?? null;
        $this->esimStatus = $values['esimStatus'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
