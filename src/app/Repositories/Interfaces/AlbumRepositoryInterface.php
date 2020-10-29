<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AlbumRepositoryInterface
{
    public function all(): Collection;

    public function create(array $album): void;

    public function edit(array $album, int $id): void;

    public function show(int $albumId): Model;

    public function delete(int $albumId): void;
}
