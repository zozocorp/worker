<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Worker
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Worker\Model\Event;

use Worker\Model\ApiResponse;
use Worker\Model\PaginationResponse;
use Worker\Model\PagingProvider;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class EventResponse implements ApiResponse, PagingProvider
{
    use PaginationResponse;
    private $items;

    private function __construct()
    {
    }

    public static function create(array $data)
    {
        $events = [];
        if (isset($data['items'])) {
            foreach ($data['items'] as $item) {
                $events[] = Event::create($item);
            }
        }

        $model = new self();
        $model->items = $events;
        $model->paging = $data['paging'];

        return $model;
    }

    /**
     * @return Event[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
