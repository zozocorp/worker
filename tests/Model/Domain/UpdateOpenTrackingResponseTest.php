<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker\Tests\Model\Domain;

use Worker\Model\Domain\OpenTracking;
use Worker\Model\Domain\UpdateOpenTrackingResponse;
use Worker\Tests\Model\BaseModelTest;

class UpdateOpenTrackingResponseTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
  "open": {
    "active": false
  },
  "message": "Domain tracking settings have been updated"
}
JSON;
        $model = UpdateOpenTrackingResponse::create(json_decode($json, true));
        $this->assertNotEmpty($model->getMessage());
        $this->assertEquals('Domain tracking settings have been updated', $model->getMessage());
        $this->assertNotEmpty($model->getOpen());
        $this->assertInstanceOf(OpenTracking::class, $model->getOpen());
        $this->assertFalse($model->getOpen()->isActive());
    }
}
