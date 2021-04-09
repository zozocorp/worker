<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker\Model\MailingList;

use Worker\Model\ApiResponse;

final class ShowResponse implements ApiResponse
{
    private $list;

    public static function create(array $data): self
    {
        $model = new self();
        $model->list = MailingList::create($data['list']);

        return $model;
    }

    private function __construct()
    {
    }

    public function getList(): MailingList
    {
        return $this->list;
    }
}
