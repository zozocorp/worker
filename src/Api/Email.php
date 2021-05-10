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
use Worker\Message\BatchMessage;
use Worker\Model\Message\SendResponse;
use Worker\Model\Message\ShowResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @see https://documentation.worker.com/en/latest/api-sending.html
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Email extends HttpApi
{

    public function getBatchMessage(string $domain, bool $autoSend = true): BatchMessage
    {
        return new BatchMessage($this, $domain, $autoSend);
    }

    /**
     * @see https://documentation.worker.com/en/latest/api-sending.html#sending
     *
     * @return SendResponse|ResponseInterface
     * 
     * * @todo remove interface => you need more interface
     */
    
    public function send(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/email/send?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

   /**
     * Returns a single domain.
     *
     * @param string $domain name of the domain
     *
     * @return ShowResponse|array|ResponseInterface
     */
    public function verify(array $params, $headers = [])
    {
        Assert::notEmpty($params);
        $response = $this->httpPostRaw(sprintf('%s/email/verify?api_token=%s', $this->httpClient->host, $this->httpClient->apiKey), $params, $headers);
        return $response;
    }

}
