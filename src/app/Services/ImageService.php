<?php

namespace App\Services;

use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageService
{
    private ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }


    public function all()
    {
        return $this->imageRepository->all();
    }


    public function create(array $imagePayload): void
    {
        $this->imageRepository->create($imagePayload);
    }


    public function delete(int $imageId): void
    {
        $this->imageRepository->delete($imageId);
    }
}
