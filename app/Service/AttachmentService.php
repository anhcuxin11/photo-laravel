<?php

namespace App\Service;

use App\Exceptions\ApiException;
use App\Models\Attachment;
use App\Repository\AttachmentRepository;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AttachmentService
{
    /**
     * @var AttachmentRepository
     */
    protected $attachmentRepository;

    /**
     * @var UploadService
     */
    protected $uploadService;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param AttachmentRepository $attachmentRepository
     * @param UploadService $uploadService
     * @param UserRepository $userRepository
     */
    public function __construct(
        AttachmentRepository $attachmentRepository,
        UploadService $uploadService,
        UserRepository $userRepository
    ){
        $this->attachmentRepository = $attachmentRepository;
        $this->uploadService = $uploadService;
        $this->userRepository = $userRepository;
    }

    /**
     * Store user attachment
     *
     * @param int $id
     * @param object $file
     *
     * @return Attachment
     */
    public function store(int $id, object $file)
    {
        $user = $this->userRepository->getById($id);
        if (!$user) {
            throw ApiException::notFound('User does not exist.');
        }

        $fileName = $file->hashName();
        $data = $this->uploadService->upload($id . '/' . $fileName, $file);
        if (!$data) {
            throw ApiException::badRequest('Upload failed.');
        }

        $attachment = DB::transaction(function () use ($data, $user) {
            $attachment = $this->attachmentRepository->store([
                'upload_file_name' => $data['name'],
                'upload_file_path' => $data['path']
            ]);

            $user->attachments()->syncWithoutDetaching([$attachment->id]);

            return $attachment;
        });

        if ($attachment) {
            $attachment->load('users');
        }

        return $attachment;
    }

    /**
     * Delete user attachment
     *
     * @param int $id
     * @param int $attachment
     */
    public function delete(int $id, int $attachmentId)
    {
        $user = $this->userRepository->getById($id);
        if (!$user) {
            throw ApiException::notFound('User does not exist.');
        }

        $attachment = $this->attachmentRepository->getById($attachmentId);

        if (!$attachment) {
            throw ApiException::notFound('Attachment does not exist.');
        }

        $data = $this->uploadService->delete($attachment->upload_file_path);

        if (!$data) {
            throw ApiException::badRequest('Delete attachment is failed.');
        }

        $attachment->delete();
        $user->attachments()->detach($attachmentId);
    }

    /**
     * @param int $userId
     *
     * @return Collection
     */
    public function list(int $userId)
    {
        $user = $this->userRepository->getById($userId);
        if (!$user) {
            throw ApiException::notFound('User does not exist.');
        }

        return $this->attachmentRepository->getAll($userId);
    }
}

