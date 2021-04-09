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

final class ValidationStatusDownloadUrl implements ApiResponse
{
    private $csv;
    private $json;

    public static function create(array $data): self
    {
        $model = new self();
        $model->csv = $data['csv'] ?? null;
        $model->json = $data['json'] ?? null;

        return $model;
    }

    private function __construct()
    {
    }

    public function getCsv(): ?string
    {
        return $this->csv;
    }

    public function getJson(): ?string
    {
        return $this->json;
    }
}
