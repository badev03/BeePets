<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Pusher\Pusher;

class NotificationBirdayDoctor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification-birday-doctor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi thông báo sinh nhật cho các bác sĩ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $doctorsWithBirthday = DB::table('doctors')
            ->whereDate('birthday', $today->toDateString())
            ->get();
        if(count($doctorsWithBirthday)>0) {
            foreach ($doctorsWithBirthday as $key=>$item) {
                $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
                    'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                    'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
                ]);
                $pusher->trigger("doctor-notification-".$item->id, 'notification-event-doctor', 'chúc mừng sinh nhaatk bạn');
                Notification::create([
                    'doctor_id' => $item->id,
                    'message_doctor' => 'Chúc mừng sinh nhật '.$item->name
                ]);
            }}
    }
}
