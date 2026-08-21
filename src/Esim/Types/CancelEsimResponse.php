<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class CancelEsimResponse extends JsonSerializableType
{
    /**
     * @var bool $success
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var ?float $refundedAmount
     */
    #[JsonProperty('refundedAmount')]
    public ?float $refundedAmount;

    /**
     * @param array{
     *   success: bool,
     *   refundedAmount?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->refundedAmount = $values['refundedAmount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
