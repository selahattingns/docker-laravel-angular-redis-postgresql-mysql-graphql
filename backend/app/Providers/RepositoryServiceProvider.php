<?php

namespace App\Providers;

use App\Repositories\Pages\CommentRepository;
use App\Repositories\Pages\PostRepository;
use App\Interfaces\Pages\CommentInterface;
use App\Interfaces\Pages\PostInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(CommentInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
