<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Interfaces\MessageUser;
use App\Services\MessageService;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(MessageUser::class, MessageService::class);
        Schema::defaultStringLength(191);
        Sanctum::usePersonalAccessTokenModel(now()->addDays(1));
    }
}
