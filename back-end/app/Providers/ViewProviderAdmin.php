<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\View;
class ViewProviderAdmin extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->Notification();
    }

    private function Notification() {
        View::composer('layouts.partials.header', function ($view) {
            $notification = Notification::select('notifications.id', 'users.name' , 'message' , 'notifications.created_at')
                ->join('users' , 'users.id' , '=' , 'notifications.user_id')
                ->get();
            $view->with('notification', $notification);
        });
    }
}
