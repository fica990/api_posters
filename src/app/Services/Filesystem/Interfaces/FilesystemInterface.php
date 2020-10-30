<?php


namespace App\Services\Filesystem\Interfaces;


use Illuminate\Http\UploadedFile;

interface FilesystemInterface
{
    public function upload(string $bucket, string $filePath, UploadedFile $file): void;

    public function delete(string $file): void;
}
