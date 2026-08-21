<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class OrderEsimResponse extends JsonSerializableType
{
    /**
     * @var string $transactionId Reseller-assigned transaction ID
     */
    #[JsonProperty('transaction_id')]
    public string $transactionId;

    /**
     * @var array<string> $esimIds
     */
    #[JsonProperty('esim_ids'), ArrayType(['string'])]
    public array $esimIds;

    /**
     * @param array{
     *   transactionId: string,
     *   esimIds: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transactionId = $values['transactionId'];
        $this->esimIds = $values['esimIds'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
