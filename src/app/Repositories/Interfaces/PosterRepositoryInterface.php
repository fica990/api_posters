<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface PosterRepositoryInterface
{
    public function create(Model $image, array $posterData): Model;

    public function edit(array $poster, int $id): Model;

    public function getById(int $id): Model;

    public function delete(int $id): void;
}
