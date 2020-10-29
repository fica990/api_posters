<?php


namespace App\Repositories;


use App\Models\Album;
use App\Repositories\Interfaces\AlbumRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AlbumRepository extends BaseRepository implements AlbumRepositoryInterface
{
    public function all(): Collection
    {
        return $this->model->all();
    }


    public function create(array $album): void
    {
        $album = new Album($album);
        $album->saveOrFail();
    }


    public function edit(array $albumData, int $id): void
    {
        $album = $this->model->findOrFail($id);
        $album->fill($albumData)->save();
    }


    public function show(int $albumId): Model
    {
        return $this->model->with('posters')->findOrFail($albumId);
    }


    public function delete(int $albumId): void
    {
        $this->model->destroy($albumId);
    }


    protected function getModelResource(): string
    {
        return Album::class;
    }
}
