<?php


namespace App\Services;


use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\PosterRepositoryInterface;
use App\Services\GeneratePoster\Interfaces\GeneratePosterInterface;

class PosterService
{
    private PosterRepositoryInterface $posterRepository;
    private ImageRepositoryInterface $imageRepository;
    private GeneratePosterInterface $generatePoster;

    public function __construct(PosterRepositoryInterface $posterRepository,
                                ImageRepositoryInterface $imageRepository,
                                GeneratePosterInterface $generatePoster)
    {
        $this->posterRepository = $posterRepository;
        $this->imageRepository = $imageRepository;
        $this->generatePoster = $generatePoster;
    }

    public function create(array $posterData, int $imageId): void
    {
        $image = $this->imageRepository->getById($imageId);

        $this->generatePoster->generate($image, $posterData);

        $this->posterRepository->create($image, $posterData);

        $this->imageRepository->edit(['is_poster' => 1], $imageId);
    }
}
