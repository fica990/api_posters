<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ImageRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): Model;

    public function create(array $image): void;

    public function delete(int $imageId): void;
}
