<?php

namespace App\Providers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Album::generate();
        User::generate();
        Album::currentUserCreateAlbum();
        Paginator::useBootstrap();
    }
}
