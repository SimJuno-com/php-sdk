<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;

class CancelEsimRequest extends JsonSerializableType
{
    /**
     * @param array{
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        unset($values);
    }
}
