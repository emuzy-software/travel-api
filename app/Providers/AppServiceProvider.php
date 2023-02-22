<?php

namespace App\Providers;

use App\Repositories\Authentication\UserRepository;
use App\Repositories\Authentication\UserRepositoryInterface;
use App\Repositories\CategoriesRepository;
use App\Repositories\CategoriesRespositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoriesRespositoryInterface::class, CategoriesRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
