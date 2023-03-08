<?php

namespace App\Providers;

use App\Repositories\Authentication\UserRepository;
use App\Repositories\Authentication\UserRepositoryInterface;
use App\Repositories\CategoriesRepository;
use App\Repositories\CategoriesRespositoryInterface;
use App\Repositories\BlogRepository;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\BookingRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use App\Repositories\Authentication\UserVerifyTokenRepository;
use App\Repositories\Authentication\UserVerifyTokenRepositoryInterface;
use App\Repositories\Authentication\ResetPasswordTokenRepository;
use App\Repositories\Authentication\ResetPasswordTokenRepositoryInterface;
use App\Repositories\CategoryBlogRepository;
use App\Repositories\CategoryBlogRepositoryInterface;
use App\Repositories\ExperienceRepository;
use App\Repositories\ExperienceRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CategoriesRespositoryInterface::class, CategoriesRepository::class);
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(UserVerifyTokenRepositoryInterface::class, UserVerifyTokenRepository::class);
        $this->app->bind(ResetPasswordTokenRepositoryInterface::class, ResetPasswordTokenRepository::class);
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
        $this->app->bind(CategoryBlogRepositoryInterface::class, CategoryBlogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
