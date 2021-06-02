<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker\Api;
use Worker\Assert;

/**
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Search extends HttpApi
{
    public function fullText(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    public function insertData(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search/insert?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    public function getData(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search/get?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    public function deleteData(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search/delete?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    public function createIndex(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search/create-index?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    public function deleteIndex(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/search/delete-index?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

}
