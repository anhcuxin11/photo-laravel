<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttachmentRequest;
use App\Service\AttachmentService;
use App\Transformers\SuccessResource;
use App\Transformers\UserAttachmentResource;
use App\Transformers\UserListAttachmentResource;

class UserAttachmentController extends Controller
{
    /**
     * @var AttachmentService
     */
    protected $attachmentService;

    /**
     * @param AttachmentService $attachmentService
     */
    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }

    /**
     *@param StoreAttachmentRequest $request
     */
    public function store(int $id, StoreAttachmentRequest $request)
    {
        $attachment = $this->attachmentService->store($id, $request->file('file'));

        return UserAttachmentResource::make($attachment);
    }

    /**
     * @param int $id
     * @param int $attachmentId
     */
    public function delete(int $id, int $attachmentId)
    {
        $this->attachmentService->delete($id, $attachmentId);

        return SuccessResource::make();
    }

    /**
     * @param int $userId
     */
    public function list(int $userId)
    {
        $images = $this->attachmentService->list($userId);

        return UserListAttachmentResource::make($images);
    }
}
