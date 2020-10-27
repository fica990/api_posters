<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $imagePayload
     * @throws \Throwable
     */
    public function create(array $imagePayload): void
    {
        $image = new Image($imagePayload);
        $image->saveOrFail();
    }

    public function delete(int $imageId): void
    {
        dd($imageId);
    }


    protected function getModelResource(): string
    {
        return Image::class;
    }
}
