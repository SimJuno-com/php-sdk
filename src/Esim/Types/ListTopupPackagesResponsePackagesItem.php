<?php

namespace Simjuno\Esim\Types;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Core\Types\ArrayType;

class ListTopupPackagesResponsePackagesItem extends JsonSerializableType
{
    /**
     * @var string $packageCode
     */
    #[JsonProperty('packageCode')]
    public string $packageCode;

    /**
     * @var string $slug
     */
    #[JsonProperty('slug')]
    public string $slug;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var float $price
     */
    #[JsonProperty('price')]
    public float $price;

    /**
     * @var string $currencyCode
     */
    #[JsonProperty('currencyCode')]
    public string $currencyCode;

    /**
     * @var float $volume
     */
    #[JsonProperty('volume')]
    public float $volume;

    /**
     * @var float $smsStatus
     */
    #[JsonProperty('smsStatus')]
    public float $smsStatus;

    /**
     * @var float $dataType
     */
    #[JsonProperty('dataType')]
    public float $dataType;

    /**
     * @var float $unusedValidTime
     */
    #[JsonProperty('unusedValidTime')]
    public float $unusedValidTime;

    /**
     * @var float $duration
     */
    #[JsonProperty('duration')]
    public float $duration;

    /**
     * @var string $durationUnit
     */
    #[JsonProperty('durationUnit')]
    public string $durationUnit;

    /**
     * @var string $location
     */
    #[JsonProperty('location')]
    public string $location;

    /**
     * @var string $description
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var float $activeType
     */
    #[JsonProperty('activeType')]
    public float $activeType;

    /**
     * @var string $speed
     */
    #[JsonProperty('speed')]
    public string $speed;

    /**
     * @var array<ListTopupPackagesResponsePackagesItemLocationNetworkListItem> $locationNetworkList
     */
    #[JsonProperty('locationNetworkList'), ArrayType([ListTopupPackagesResponsePackagesItemLocationNetworkListItem::class])]
    public array $locationNetworkList;

    /**
     * @var string $ipExport
     */
    #[JsonProperty('ipExport')]
    public string $ipExport;

    /**
     * @var float $supportTopUpType
     */
    #[JsonProperty('supportTopUpType')]
    public float $supportTopUpType;

    /**
     * @var ?string $fupPolicy
     */
    #[JsonProperty('fupPolicy')]
    public ?string $fupPolicy;

    /**
     * @var ?array<ListTopupPackagesResponsePackagesItemSubLocationListItem> $subLocationList
     */
    #[JsonProperty('subLocationList'), ArrayType([ListTopupPackagesResponsePackagesItemSubLocationListItem::class])]
    public ?array $subLocationList;

    /**
     * @param array{
     *   packageCode: string,
     *   slug: string,
     *   name: string,
     *   price: float,
     *   currencyCode: string,
     *   volume: float,
     *   smsStatus: float,
     *   dataType: float,
     *   unusedValidTime: float,
     *   duration: float,
     *   durationUnit: string,
     *   location: string,
     *   description: string,
     *   activeType: float,
     *   speed: string,
     *   locationNetworkList: array<ListTopupPackagesResponsePackagesItemLocationNetworkListItem>,
     *   ipExport: string,
     *   supportTopUpType: float,
     *   fupPolicy?: ?string,
     *   subLocationList?: ?array<ListTopupPackagesResponsePackagesItemSubLocationListItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->packageCode = $values['packageCode'];
        $this->slug = $values['slug'];
        $this->name = $values['name'];
        $this->price = $values['price'];
        $this->currencyCode = $values['currencyCode'];
        $this->volume = $values['volume'];
        $this->smsStatus = $values['smsStatus'];
        $this->dataType = $values['dataType'];
        $this->unusedValidTime = $values['unusedValidTime'];
        $this->duration = $values['duration'];
        $this->durationUnit = $values['durationUnit'];
        $this->location = $values['location'];
        $this->description = $values['description'];
        $this->activeType = $values['activeType'];
        $this->speed = $values['speed'];
        $this->locationNetworkList = $values['locationNetworkList'];
        $this->ipExport = $values['ipExport'];
        $this->supportTopUpType = $values['supportTopUpType'];
        $this->fupPolicy = $values['fupPolicy'] ?? null;
        $this->subLocationList = $values['subLocationList'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
