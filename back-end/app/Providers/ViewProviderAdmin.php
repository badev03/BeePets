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
            $notification = Notification::select('notifications.id', 'users.name' ,'users.avatar',
                'message' , 'notifications.created_at' , 'notifications.appointment_id' , 'notifications.message_admin')
                ->join('users' , 'users.id' , '=' , 'notifications.user_id')
                ->whereNotNull('notifications.message_admin')
                ->orderBy('id','desc')
                ->get();
            $unreadNotificationCount = Notification::where('read', 0)
                ->count();
            $view->with('notification', $notification);
            $view->with('unreadNotificationCount' , $unreadNotificationCount);
        });
    }
}
