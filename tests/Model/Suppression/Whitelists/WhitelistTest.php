<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker\Tests\Model\Suppression\Whitelists;

use Worker\Model\Suppression\Whitelist\Whitelist;
use Worker\Tests\Model\BaseModelTest;

class WhitelistTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "value": "alice@example.com",
    "reason": "why the record was created",
    "type": "address",
    "createdAt": "Fri, 21 Oct 2011 11:02:55 GMT"
}
JSON;

        $model = Whitelist::create(json_decode($json, true));
        $this->assertEquals('alice@example.com', $model->getValue());
        $this->assertEquals('why the record was created', $model->getReason());
        $this->assertEquals('address', $model->getType());
        $this->assertEquals('2011-10-21 11:02:55', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }
}
