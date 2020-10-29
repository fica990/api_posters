<?php


namespace App\Services;


use App\Repositories\Interfaces\AlbumRepositoryInterface;

class AlbumService
{
    private AlbumRepositoryInterface $albumRepository;

    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }


    public function all()
    {
        return $this->albumRepository->all();
    }


    public function create(array $album): void
    {
        $this->albumRepository->create($album);
    }


    public function edit(array $album, int $id): void
    {
        $this->albumRepository->edit($album, $id);
    }


    public function show(int $albumId)
    {
        return $this->albumRepository->show($albumId);
    }


    public function delete(int $albumId): void
    {
        $this->albumRepository->delete($albumId);
    }

}
