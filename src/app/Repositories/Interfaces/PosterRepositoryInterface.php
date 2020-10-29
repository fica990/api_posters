<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface PosterRepositoryInterface
{
    public function create(Model $image, array $posterData): void;
}
