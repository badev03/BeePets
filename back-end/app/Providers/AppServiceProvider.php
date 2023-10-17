<?php

namespace App\Providers;

use App\Interfaces\MessageUser;
use App\Services\MessageService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
    }
}
