<?php


namespace App\Services\Filesystem;


use App\Services\Filesystem\Interfaces\FilesystemInterface;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class S3Filesystem implements FilesystemInterface
{
    private $adapter;

    public function __construct(FilesystemManager $manager)
    {
        $this->adapter = $manager->drive('local');
    }

    public function upload(string $bucket, string $filePath, UploadedFile $file): void
    {
        $this->adapter->putFileAs($bucket, $file, $filePath);
    }
}
