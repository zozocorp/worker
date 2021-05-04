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
class Image extends HttpApi
{
     /**
     * @return EventResponse
     */
    public function shrink(array $params, array $headers = [])
    {
        Assert::notEmpty($params['image']);
        Assert::notEmpty($params['image']['size']);
        Assert::notEmpty($params['image']['type']);
        Assert::notEmpty($params['image']['tmp_name']);
        
        $file['size'] = $params['image']['size'];
        $file['type'] = $params['image']['type'];
        $file['content'] = base64_encode(file_get_contents($params['image']['tmp_name']));
        $response = $this->httpPostRaw(sprintf('%s/image/shrink?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $file, $headers);
        return $response;
    }
}
