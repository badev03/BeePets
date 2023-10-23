<?php

namespace App\Livewire;

use App\Jobs\SendNotificationTimeLine;
use App\Traits\QueryCommon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Carbon\Carbon;
class TimeLine extends Component
{
    use QueryCommon;
    public $date_send;
    public $roles_notification = [];
    public $time_send;
    public $messageUser;
    public function render()
    {
        $roles = $this->tableQuery('roles')
            ->select('id' , 'name')
            ->get();
        return view('livewire.time-line' , compact('roles'));
    }

    public function SetTime() {
        $rules = [
            'messageUser' => 'required',
        ];
        $customMessages = [
            'messageUser.required' => 'Nội dung cần được điền.',
        ];
        // Kiểm tra xác thực
        $this->validate($rules, $customMessages);
            $user = $this->tableQuery('users')
                ->whereIn('role_id',$this->roles_notification)
                ->select('id' , 'name')->get();
            $sendDateTime = now()->parse($this->date_send.' '.$this->time_send);

        $sendDateTimes = Carbon::create(2023, 10, 21, 20, 53, 0, 'Asia/Ho_Chi_Minh');

// Sử dụng đối tượng Carbon để lên lịch công việc với thời gian delay
            foreach ($user as $key=>$item) {
//                SendNotificationTimeLine::dispatch($item->id, $this->time_send, 'hehe')
//                    ->onQueue('TimeLineNotification')
//                    ->delay($sendDateTimes);
//                SendNotificationTimeLine::dispatchSync($item->id, $this->time_send, 'hehe');
                SendNotificationTimeLine::dispatch($item->id, $this->time_send, $this->messageUser)
                    ->onQueue('TimeLineNotification')
                    ->delay($sendDateTime);
            }
        Session::flash('success_message', 'Set Time Line Thông báo thành công');
    }
}
