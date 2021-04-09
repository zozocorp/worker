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
use Worker\Tests\Model\BaseModelTest;

class OpenTrackingTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "active": true
}
JSON;
        $model = OpenTracking::create(json_decode($json, true));
        $this->assertTrue($model->isActive());
    }
}
