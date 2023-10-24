<?php

namespace App\Providers;

use App\Repositories\Contracts\userRepositoryInterface;
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
        $this->app->bind(userRepositoryInterface::class, jsonUserRepository::class);
    }
}
