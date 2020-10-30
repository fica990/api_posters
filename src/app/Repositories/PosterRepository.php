<?php


namespace App\Repositories;


use App\Models\Poster;
use App\Repositories\Interfaces\PosterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PosterRepository extends BaseRepository implements PosterRepositoryInterface
{
    public function create(Model $image, array $posterData): Model
    {
        $poster = new Poster();

        $poster->name = $posterData['poster_name'];
        $poster->path = $image->path;
        $poster->background_color = $posterData['bg_color'];
        $poster->title = $posterData['title'];
        $poster->description = $posterData['text'];
        $poster->image_id = $image->id;
        $poster->album_id = $posterData['album_id'];

        $poster->saveOrFail();

        return $poster;
    }


    public function edit(array $posterData, int $id): Model
    {
        $poster = $this->model->findOrFail($id);

        $poster->background_color = $posterData['bg_color'];
        $poster->title = $posterData['title'];
        $poster->description = $posterData['text'];
        $poster->album_id = $posterData['album_id'];

        $poster->saveOrFail();

        return $poster;
    }

    public function getById(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }


    protected function getModelResource(): string
    {
        return Poster::class;
    }

}
