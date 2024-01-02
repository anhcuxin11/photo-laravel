<?php

namespace App\Transformers;

use Carbon\Carbon;

class UserAttachmentResource extends Resource
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
        return [
            'id' => $this->resource->id,
            'user_id' => $this->resource->users->first()->id,
            'upload_file_name' => $this->resource->upload_file_name,
            'upload_file_path' => $this->resource->upload_file_path,
            'created_at' => Carbon::parse($this->resource->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->resource->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
