<?php

namespace App\Helpers;

class Common
{
    /**
     * @param $resource
     * @return array
     */
    public static function pagination($resource): array
    {
        return [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
        ];
    }
}
