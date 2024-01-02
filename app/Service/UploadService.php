<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * @param string $path
     */
    public function delete(string $path)
    {
        try {
            Storage::disk('public')->delete($path);

            return true;
        } catch (Exception $e) {
            Log::info('ERROR_DELETE_FILE_UPLOAD' . $e->getMessage());

            return false;
        }
    }

    /**
     * @param string $path
     * @param object $file
     */
    public function upload(string $path, object $file)
    {
        try {
            $fileNameUpload = $file->getClientOriginalName();

            Storage::disk('public')->put($path, file_get_contents($file));

            return [
                'name' => $fileNameUpload,
                'path' => $path,
                'type' => $file->getClientOriginalExtension(),
                'size' => $file->getSize()
            ];
        } catch (Exception $e) {
            Log::info('ERROR_UPLOAD_FILE' . $e->getMessage());

            return false;
        }

    }
}

