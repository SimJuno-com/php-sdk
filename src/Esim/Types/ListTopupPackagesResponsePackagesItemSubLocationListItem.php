<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class ListTopupPackagesResponsePackagesItemSubLocationListItem extends JsonSerializableType
{
    /**
     * @var string $code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @param array{
     *   code: string,
     *   name: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->name = $values['name'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
