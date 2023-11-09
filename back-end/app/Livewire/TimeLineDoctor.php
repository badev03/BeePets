<?php

namespace App\Livewire;

use App\Jobs\SendNotificationTimeLine;
use App\Traits\QueryCommon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class TimeLineDoctor extends Component
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
        return view('livewire.time-line-doctor' , compact('roles'));
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
        $doctors = $this->tableQuery('doctors')
            ->select('id' , 'name')->get();
        $sendDateTime = now()->parse($this->date_send.' '.$this->time_send);

        foreach ($doctors as $key=>$item) {
            \App\Jobs\NotificationDoctor::dispatch($item->id, $this->time_send, $this->messageUser)
                ->onQueue('TimeLineNotificationDoctor')
                ->delay($sendDateTime);
        }
        Session::flash('success_message', 'Set Time Line Thông báo thành công');
    }
}
