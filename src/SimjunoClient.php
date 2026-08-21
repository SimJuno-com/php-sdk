<?php

namespace Simjuno;

use Simjuno\Reseller\ResellerClient;
use Simjuno\Esim\EsimClient;
use Psr\Http\Client\ClientInterface;
use Simjuno\Core\Client\RawClient;

class SimjunoClient
{
    /**
     * @var ResellerClient $reseller
     */
    public ResellerClient $reseller;

    /**
     * @var EsimClient $esim
     */
    public EsimClient $esim;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param string $apiKey The apiKey to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        string $apiKey,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'x-api-key' => $apiKey,
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Simjuno',
            'X-Fern-SDK-Version' => '0.0.5',
            'User-Agent' => 'simjuno/simjuno/0.0.5',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->reseller = new ResellerClient($this->client, $this->options);
        $this->esim = new EsimClient($this->client, $this->options);
    }
}
