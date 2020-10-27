<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface ImageRepositoryInterface
{
    public function all(): Collection;

    public function create(array $image): void;

    public function delete(int $imageId): void;
}
