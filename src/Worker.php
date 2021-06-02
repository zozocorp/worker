<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker;

use Http\Client\Common\PluginClient;
use Worker\HttpClient\HttpClientConfigurator;
use Worker\HttpClient\Plugin\History;
use Worker\HttpClient\RequestBuilder;
use Worker\Hydrator\Hydrator;
use Worker\Hydrator\ModelHydrator;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * This class is the base class for the Worker SDK.
 */
class Worker
{
    /**
     * @var string|null
     */
    private $apiKey;

    /**
     * @var ClientInterface|PluginClient
     */
    private $httpClient;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

     /**
     * @var string
     */
    private static $host = 'https://worker.zozo.vn/api/v1';

    /**
     * This is a object that holds the last response from the API.
     *
     * @var History
     */
    private $responseHistory;

    public function __construct(
        HttpClientConfigurator $configurator,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
        $this->hydrator = $hydrator ?: new ModelHydrator();

        $this->httpClient = $configurator->createConfiguredClient();
        $this->apiKey = $configurator->getApiKey();
        $this->responseHistory = $configurator->getResponseHistory();
        $this->httpClient->apiKey = $configurator->getApiKey();
        $this->httpClient->host = self::$host;
    }

    public static function create(string $apiKey, string $endpoint = 'https://worker.zozo.vn/api/v1'): self
    {
        $httpClientConfigurator = (new HttpClientConfigurator())
            ->setApiKey($apiKey);
        return new self($httpClientConfigurator);
    }

    public function email(): Api\Email
    {
        return new Api\Email($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function template(): Api\Template
    {
        return new Api\Template($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function image(): Api\Image
    {
        return new Api\Image($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function ip(): Api\Ip
    {
        return new Api\Ip($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function url(): Api\Url
    {
        return new Api\Url($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function qrCode(): Api\QrCode
    {
        return new Api\QrCode($this->httpClient, $this->requestBuilder, $this->hydrator);
    }

    public function search(): Api\Search
    {
        return new Api\Search($this->httpClient, $this->requestBuilder, $this->hydrator);
    }
}
