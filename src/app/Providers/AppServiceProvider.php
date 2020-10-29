<?php

namespace App\Providers;

use App\Repositories\AlbumRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\AlbumRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\PosterRepositoryInterface;
use App\Repositories\PosterRepository;
use App\Services\Filesystem\Interfaces\FilesystemInterface;
use App\Services\Filesystem\S3Filesystem;
use App\Services\GeneratePoster\ImagickGeneratePoster;
use App\Services\GeneratePoster\Interfaces\GeneratePosterInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->singleton(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->singleton(PosterRepositoryInterface::class, PosterRepository::class);
        $this->app->singleton(FilesystemInterface::class, S3Filesystem::class);
        $this->app->singleton(GeneratePosterInterface::class, ImagickGeneratePoster::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
