<?php

namespace App\Transformers;

use Carbon\Carbon;

class ModelResource extends Resource
{
    /**
     * @param $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource = null, int $code = 200, string $message = 'Successful')
    {
        parent::__construct($resource, new MetaResource($code, $message, null));
    }

    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
