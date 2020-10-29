<?php


namespace App\Services\GeneratePoster\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface GeneratePosterInterface
{
    public function generate(Model $image, array $posterData): void;
}
