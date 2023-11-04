<?php

namespace App\Providers;

use App\Repositories\Contracts\categoryRepositoryInterface;
use App\Repositories\Contracts\quizRepositoryInterface;
use App\Repositories\Contracts\userRepositoryInterface;
use App\Repositories\Eloquent\eloquentCategoryRepository;
use App\Repositories\Eloquent\eloquentQuizRepository;
use App\Repositories\Eloquent\eloquentUserRepository;
use App\Repositories\Json\jsonUserRepository;
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
        //
    }

    public function boot()
    {
        $this->app->bind(userRepositoryInterface::class, eloquentUserRepository::class);
        $this->app->bind(categoryRepositoryInterface::class, eloquentCategoryRepository::class);
        $this->app->bind(quizRepositoryInterface::class, eloquentQuizRepository::class);
    }
}
