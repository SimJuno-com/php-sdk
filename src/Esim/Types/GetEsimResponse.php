<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;

class GetEsimResponse extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $slug
     */
    #[JsonProperty('slug')]
    public string $slug;

    /**
     * @var ?string $locationLogo
     */
    #[JsonProperty('location_logo')]
    public ?string $locationLogo;

    /**
     * @var ?float $unusedValidTime
     */
    #[JsonProperty('unused_valid_time')]
    public ?float $unusedValidTime;

    /**
     * @var bool $archived
     */
    #[JsonProperty('archived')]
    public bool $archived;

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
     * @var ?string $expiredTime
     */
    #[JsonProperty('expired_time')]
    public ?string $expiredTime;

    /**
     * @var ?string $qrCodeUrl
     */
    #[JsonProperty('qrCodeUrl')]
    public ?string $qrCodeUrl;

    /**
     * @var ?string $shortUrl
     */
    #[JsonProperty('shortUrl')]
    public ?string $shortUrl;

    /**
     * @var ?string $ac
     */
    #[JsonProperty('ac')]
    public ?string $ac;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   slug: string,
     *   archived: bool,
     *   dataUsage: float,
     *   totalData: float,
     *   locationLogo?: ?string,
     *   unusedValidTime?: ?float,
     *   lastDataUsageUpdateTime?: ?string,
     *   esimStatus?: ?string,
     *   expiredTime?: ?string,
     *   qrCodeUrl?: ?string,
     *   shortUrl?: ?string,
     *   ac?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->slug = $values['slug'];
        $this->locationLogo = $values['locationLogo'] ?? null;
        $this->unusedValidTime = $values['unusedValidTime'] ?? null;
        $this->archived = $values['archived'];
        $this->dataUsage = $values['dataUsage'];
        $this->totalData = $values['totalData'];
        $this->lastDataUsageUpdateTime = $values['lastDataUsageUpdateTime'] ?? null;
        $this->esimStatus = $values['esimStatus'] ?? null;
        $this->expiredTime = $values['expiredTime'] ?? null;
        $this->qrCodeUrl = $values['qrCodeUrl'] ?? null;
        $this->shortUrl = $values['shortUrl'] ?? null;
        $this->ac = $values['ac'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
