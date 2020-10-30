<?php


namespace App\Services;


use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\PosterRepositoryInterface;
use App\Services\Filesystem\Interfaces\FilesystemInterface;
use App\Services\GeneratePoster\Interfaces\GeneratePosterInterface;
use Illuminate\Database\Eloquent\Model;

class PosterService
{
    private PosterRepositoryInterface $posterRepository;
    private ImageRepositoryInterface $imageRepository;
    private GeneratePosterInterface $generatePoster;
    private FilesystemInterface $filesystem;

    public function __construct(PosterRepositoryInterface $posterRepository,
                                ImageRepositoryInterface $imageRepository,
                                GeneratePosterInterface $generatePoster,
                                FilesystemInterface $filesystem)
    {
        $this->posterRepository = $posterRepository;
        $this->imageRepository = $imageRepository;
        $this->generatePoster = $generatePoster;
        $this->filesystem = $filesystem;
    }

    public function create(array $posterData, int $imageId): Model
    {
        $image = $this->imageRepository->getById($imageId);

        $posterName = $this->generatePoster->generate($image, $posterData);

        $posterData['poster_name'] = $posterName;

        return $this->posterRepository->create($image, $posterData);
    }

    public function edit(array $posterData, int $id): Model
    {
        $poster = $this->posterRepository->getById($id);

        //keep the old poster name before generating an edited image
        $posterData['poster_name'] = $poster->name;
        $this->generatePoster->generate($poster->image, $posterData);

        return $this->posterRepository->edit($posterData, $id);
    }

    public function delete(int $id): void
    {
        $poster = $this->posterRepository->getById($id);

        $this->posterRepository->delete($id);

        $this->filesystem->delete($poster->path . $poster->name);
    }
}
