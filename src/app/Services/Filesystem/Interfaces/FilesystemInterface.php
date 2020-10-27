<?php


namespace App\Services\Filesystem\Interfaces;


use Illuminate\Http\UploadedFile;

interface FilesystemInterface
{
    public function upload(string $bucket, string $filePath, UploadedFile $file): void;
}
