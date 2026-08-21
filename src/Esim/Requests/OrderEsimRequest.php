<?php

namespace Simjuno\Esim\Requests;

use Simjuno\Core\Json\JsonSerializableType;
use Simjuno\Core\Json\JsonProperty;
use Simjuno\Esim\Types\OrderEsimRequestOrderListItem;
use Simjuno\Core\Types\ArrayType;

class OrderEsimRequest extends JsonSerializableType
{
    /**
     * @var string $transactionId Reseller-assigned transaction ID
     */
    #[JsonProperty('transaction_id')]
    public string $transactionId;

    /**
     * @var array<OrderEsimRequestOrderListItem> $orderList
     */
    #[JsonProperty('orderList'), ArrayType([OrderEsimRequestOrderListItem::class])]
    public array $orderList;

    /**
     * @param array{
     *   transactionId: string,
     *   orderList: array<OrderEsimRequestOrderListItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transactionId = $values['transactionId'];
        $this->orderList = $values['orderList'];
    }
}
