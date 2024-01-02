<?php

namespace App\Transformers;

use Carbon\Carbon;

class ChatResource extends Resource
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
        return $this->resource->map(function ($chat) {
            return [
                'id' => $chat->id,
                'user_id' => $chat->user_id,
                'message' => $chat->message,
                'user' => [
                    'id' => $chat->user()->id,
                    'name' => $chat->user()->name,
                ],
            ];
        })->toArray();
    }
}
