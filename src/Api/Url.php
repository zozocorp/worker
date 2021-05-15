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
use Worker\Model\Ip\IndexResponse;
use Worker\Model\Ip\ShowResponse;
use Worker\Model\Ip\UpdateResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @see https://documentation.worker.com/en/latest/api-ips.html
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Url extends HttpApi
{
    /**
     * Returns a single ip.
     *
     * @return ShowResponse|ResponseInterface
     */
    public function screenshot(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/url/screenshot?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    /**
     * Returns a single ip.
     *
     * @return ShowResponse|ResponseInterface
     */
    public function short(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/url/short?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }
}
