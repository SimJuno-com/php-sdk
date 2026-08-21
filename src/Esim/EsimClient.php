<?php

namespace Simjuno\Esim;

use Psr\Http\Client\ClientInterface;
use Simjuno\Core\Client\RawClient;
use Simjuno\Esim\Requests\ListEsimsRequest;
use Simjuno\Esim\Types\ListEsimsResponse;
use Simjuno\Exceptions\SimjunoException;
use Simjuno\Exceptions\SimjunoApiException;
use Simjuno\Core\Json\JsonApiRequest;
use Simjuno\Environments;
use Simjuno\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Simjuno\Esim\Requests\OrderEsimRequest;
use Simjuno\Esim\Types\OrderEsimResponse;
use Simjuno\Esim\Requests\ListDestinationsRequest;
use Simjuno\Esim\Types\ListDestinationsResponse;
use Simjuno\Esim\Types\ListPackagesResponse;
use Simjuno\Esim\Requests\GetPackageRequest;
use Simjuno\Esim\Types\GetPackageResponse;
use Simjuno\Esim\Types\ListTopupPackagesResponse;
use Simjuno\Esim\Types\GetEsimResponse;
use Simjuno\Esim\Requests\CheckUsageRequest;
use Simjuno\Esim\Types\CheckUsageResponse;
use Simjuno\Esim\Requests\CancelEsimRequest;
use Simjuno\Esim\Types\CancelEsimResponse;

class EsimClient
{
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
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * List eSIMs ordered by the reseller
     *
     * Example:
     * ```php
     * $client->esim->listEsims(
     *     new ListEsimsRequest([]),
     * );
     * ```
     *
     * @param ListEsimsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListEsimsResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function listEsims(ListEsimsRequest $request = new ListEsimsRequest(), ?array $options = null): ?ListEsimsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListEsimsResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Order one or more eSIM packages using the reseller wallet. Coupons are not accepted.
     *
     * Example:
     * ```php
     * $client->esim->orderEsim(
     *     new OrderEsimRequest([
     *         'transactionId' => 'transaction_id',
     *         'orderList' => [
     *             new OrderEsimRequestOrderListItem([
     *                 'slug' => 'slug',
     *                 'count' => 1,
     *             ]),
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param OrderEsimRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrderEsimResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function orderEsim(OrderEsimRequest $request, ?array $options = null): ?OrderEsimResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/order",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return OrderEsimResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get all supported destinations
     *
     * Example:
     * ```php
     * $client->esim->listDestinations(
     *     new ListDestinationsRequest([]),
     * );
     * ```
     *
     * @param ListDestinationsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListDestinationsResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function listDestinations(ListDestinationsRequest $request = new ListDestinationsRequest(), ?array $options = null): ?ListDestinationsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->sortBy != null) {
            $query['sortBy'] = $request->sortBy;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/destination",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListDestinationsResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get all packages for a specific destination
     *
     * Example:
     * ```php
     * $client->esim->listPackages(
     *     'slug',
     * );
     * ```
     *
     * @param string $slug
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPackagesResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function listPackages(string $slug, ?array $options = null): ?ListPackagesResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/destination/{$slug}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListPackagesResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get package by slug
     *
     * Example:
     * ```php
     * $client->esim->getPackage(
     *     'slug',
     *     new GetPackageRequest([]),
     * );
     * ```
     *
     * @param string $slug
     * @param GetPackageRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetPackageResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function getPackage(string $slug, GetPackageRequest $request = new GetPackageRequest(), ?array $options = null): ?GetPackageResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->topUp != null) {
            $query['topUp'] = $request->topUp;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/package/{$slug}",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetPackageResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get top up packages for a specific package
     *
     * Example:
     * ```php
     * $client->esim->listTopupPackages(
     *     'slug',
     * );
     * ```
     *
     * @param string $slug
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListTopupPackagesResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function listTopupPackages(string $slug, ?array $options = null): ?ListTopupPackagesResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/package/{$slug}/topup",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListTopupPackagesResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get detailed eSIM information by ID
     *
     * Example:
     * ```php
     * $client->esim->getEsim(
     *     'id',
     * );
     * ```
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEsimResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function getEsim(string $id, ?array $options = null): ?GetEsimResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetEsimResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get esim usage by id. Usage and status are polled from the upstream provider at most once every 5 minutes; within that window the last known values are returned unless force is set.
     *
     * Example:
     * ```php
     * $client->esim->checkUsage(
     *     'id',
     *     new CheckUsageRequest([]),
     * );
     * ```
     *
     * @param string $id
     * @param CheckUsageRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CheckUsageResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function checkUsage(string $id, CheckUsageRequest $request = new CheckUsageRequest(), ?array $options = null): ?CheckUsageResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->force != null) {
            $query['force'] = $request->force;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/{$id}/usage",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CheckUsageResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Cancel an eSIM by ID. An eSIM can only be cancelled if it has not been activated yet. Any eligible refund is returned to the reseller wallet.
     *
     * Example:
     * ```php
     * $client->esim->cancelEsim(
     *     'id',
     *     new CancelEsimRequest([]),
     * );
     * ```
     *
     * @param string $id
     * @param CancelEsimRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CancelEsimResponse
     * @throws SimjunoException
     * @throws SimjunoApiException
     */
    public function cancelEsim(string $id, CancelEsimRequest $request = new CancelEsimRequest(), ?array $options = null): ?CancelEsimResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "esim/{$id}/cancel",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CancelEsimResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new SimjunoException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new SimjunoException(message: $e->getMessage(), previous: $e);
        }
        throw new SimjunoApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
