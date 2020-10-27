<?php


namespace App\Http\Controllers;


use App\Services\Filesystem\Interfaces\FilesystemInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilesystemController extends Controller
{
    private FilesystemInterface $filesystem;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(string $bucket, string $filePath, Request $request): JsonResponse
    {
        $file = $request->file('image');

        if (!$file || !$file->isValid()) {
            return response()->json(['message' => 'file is not valid'], 400);
        }

        $this->filesystem->upload($bucket, $filePath, $file);

        return response()->json(null, 201);
    }
}
