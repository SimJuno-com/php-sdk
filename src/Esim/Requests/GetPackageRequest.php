<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;

class GetPackageRequest extends JsonSerializableType
{
    /**
     * @var ?bool $topUp
     */
    public ?bool $topUp;

    /**
     * @param array{
     *   topUp?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->topUp = $values['topUp'] ?? null;
    }
}
