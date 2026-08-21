<?php

namespace Simjuno\Reseller\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class BalanceResponse extends JsonSerializableType
{
    /**
     * @var float $balance Balance uses a factor of 10,000. Divide by 10,000 to convert to US dollars; for example, 30000 equals $3.00.
     */
    #[JsonProperty('balance')]
    public float $balance;

    /**
     * @param array{
     *   balance: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->balance = $values['balance'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
