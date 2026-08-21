<?php

namespace Simjuno\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

/**
 * The error information
 */
class ErrorInternalServerError extends JsonSerializableType
{
    /**
     * @var string $message The error message
     */
    #[JsonProperty('message')]
    public string $message;

    /**
     * @var string $code The error code
     */
    #[JsonProperty('code')]
    public string $code;

    /**
     * @var ?array<ErrorInternalServerErrorIssuesItem> $issues An array of issues that were responsible for the error
     */
    #[JsonProperty('issues'), ArrayType([ErrorInternalServerErrorIssuesItem::class])]
    public ?array $issues;

    /**
     * @param array{
     *   message: string,
     *   code: string,
     *   issues?: ?array<ErrorInternalServerErrorIssuesItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
        $this->code = $values['code'];
        $this->issues = $values['issues'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
