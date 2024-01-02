<?php

namespace App\Transformers;

use Carbon\Carbon;

class UserListAttachmentResource extends Resource
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
        return $this->resource->map(function ($image) {
            return [
                'id' => $image->id,
                'upload_file_name' => $image->upload_file_name,
                'upload_file_path' => $image->upload_file_path,
                'created_at' => Carbon::parse($image->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($image->updated_at)->format('Y-m-d H:i:s'),
            ];
        })->toArray();
    }
}
