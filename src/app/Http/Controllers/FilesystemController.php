<?php


namespace App\Http\Controllers;


use App\Http\Requests\UploadFileRequest;
use App\Services\Filesystem\Interfaces\FilesystemInterface;
use Illuminate\Http\JsonResponse;

class FilesystemController extends Controller
{
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(string $bucket, string $filePath, UploadFileRequest $request): JsonResponse
    {
        $file = $request->file('file');

        if (!$file || !$file->isValid()) {
            return new JsonResponse(['message' => 'file is not valid'], 400);
        }

        $this->filesystem->upload($bucket, $filePath, $file);

        return response()->json(null, 201);
    }
}
