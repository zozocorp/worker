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
use Worker\Model\Event\EventResponse;

/**
 * @see https://documentation.worker.com/en/latest/api-events.html
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Minify extends HttpApi
{
    use Pagination;

    /**
     * @return EventResponse
     */
    public function get(string $domain, array $params = [])
    {
        Assert::stringNotEmpty($domain);

        if (array_key_exists('limit', $params)) {
            Assert::range($params['limit'], 1, 300);
        }

        $response = $this->httpGet(sprintf('/v3/%s/events', $domain), $params);

        return $this->hydrateResponse($response, EventResponse::class);
    }

    
     /**
     * @return EventResponse
     */
    public function shrink(array $params, array $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/image/shrink?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }
}
