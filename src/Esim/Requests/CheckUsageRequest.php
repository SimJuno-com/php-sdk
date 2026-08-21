<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;

class CheckUsageRequest extends JsonSerializableType
{
    /**
     * @var ?bool $force Poll the upstream provider even if the eSIM was refreshed within the last 5 minutes.
     */
    public ?bool $force;

    /**
     * @param array{
     *   force?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->force = $values['force'] ?? null;
    }
}
