<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Services\Filesystem\Interfaces\FilesystemInterface;
use App\Services\Filesystem\S3Filesystem;
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
        $this->app->singleton(FilesystemInterface::class, S3Filesystem::class);
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
