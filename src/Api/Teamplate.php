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
use Worker\Exception\HttpClientException;
use Worker\Exception\HttpServerException;
use Worker\Exception\InvalidArgumentException;
use Worker\Model\EmailValidation\ParseResponse;
use Worker\Model\EmailValidation\ValidateResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @see https://documentation.worker.com/en/latest/api-email-validation.html
 *
 * @author David Garcia <me@davidgarcia.cat>
 */
class Teamplate extends HttpApi
{
      /**
     * @see https://documentation.mailgun.com/en/latest/api-sending.html#sending
     *
     * @return SendResponse|ResponseInterface
     * 
     * * @todo remove interface => you need more interface
     */
    
    public function AMP(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/teamplate/amp?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

    /**
     * @return EventResponse
     */
    public function minify(array $params, array $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/ip/ipinfo?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }
    
}
