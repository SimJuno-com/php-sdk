<?php

namespace Simjuno\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

/**
 * The error information
 */
class ErrorTooManyRequests extends JsonSerializableType
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
     * @var ?array<ErrorTooManyRequestsIssuesItem> $issues An array of issues that were responsible for the error
     */
    #[JsonProperty('issues'), ArrayType([ErrorTooManyRequestsIssuesItem::class])]
    public ?array $issues;

    /**
     * @param array{
     *   message: string,
     *   code: string,
     *   issues?: ?array<ErrorTooManyRequestsIssuesItem>,
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
