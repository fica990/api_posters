<?php


namespace App\Repositories;


use App\Models\Poster;
use App\Repositories\Interfaces\PosterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PosterRepository extends BaseRepository implements PosterRepositoryInterface
{
    public function create(Model $image, array $posterData): void
    {
        $poster = new Poster();
        $poster->name = "poster_$image->name";
        $poster->path = $image->path;
        $poster->background_color = $posterData['bg_color'];
        $poster->title = $posterData['title'];
        $poster->description = $posterData['text'];
        $poster->image_id = $image->id;
        $poster->album_id = $posterData['album_id'];

        $poster->saveOrFail();
    }


    protected function getModelResource(): string
    {
        return Poster::class;
    }

}
