<?php

namespace App\Transformers;

use Illuminate\Http\Request;

class LoginResource extends Resource
{
    /**
     * LoginResource constructor.
     *
     * @param null $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource = null, $code = 200, $message = "Successful")
    {
        parent::__construct($resource, new MetaResource($code, $message, null));
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
