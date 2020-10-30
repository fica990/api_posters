<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function all(): Collection
    {
        return $this->model->all();
    }


    public function getById(int $id): Model
    {
        return $imageData = $this->model->findOrFail($id);
    }


    public function create(array $imagePayload): void
    {
        $image = new Image($imagePayload);
        $image->saveOrFail();
    }


    public function delete(int $imageId): void
    {
        $this->model->destroy($imageId);
    }


    protected function getModelResource(): string
    {
        return Image::class;
    }
}
