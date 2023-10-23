<?php

namespace App\Livewire;

use App\Events\MessageSendNotification;
use App\Interfaces\MessageUser;
use App\Traits\QueryCommon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NotificationFillter extends Component
{
    use QueryCommon;
    public $searchName;
    public $filteredUsers;
    public $searchRoles;
    public $notification=[];
    public $showMockup = true;
    public $messageUser;
    public function render()
    {
        $data = $this->query()->select('id' , 'name' , 'phone')->get();
        $user = $this->query()->select('roles.name', 'users.role_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->groupBy('roles.name', 'users.role_id')
            ->get();
        return view('livewire.notification-fillter' , compact('data' , 'user'));
    }

    public function filterUsers(MessageUser $messageUser)
    {
        if($this->searchName) {
            $this->filteredUsers = $this->query()->where('phone', 'like', '%' . $this->searchName . '%')->get();
        }
        elseif($this->searchRoles) {
            $this->filteredUsers = $this->query()->where('role_id', '=', $this->searchRoles)->get();
        }
        elseif ($this->notification) {
            $rules = [
                'messageUser' => 'required',
            ];
            $customMessages = [
                'messageUser.required' => 'Nội dung cần được điền.',
            ];
            // Kiểm tra xác thực
            $this->validate($rules, $customMessages);

            $data = $this->query()->whereIn('role_id',$this->notification)->get();
            foreach ($data as $key=>$item) {
                $messageUser->sendManyUser($item->id , $this->messageUser);
            }
            Session::flash('success_message', 'Gửi đi thông báo thành công');
        }
    }

    public function query() {
        $query = $this->tableQuery('users');
        return $query;
    }

    public function clearForm() {
        $this->messageUser = '';
        $this->notification = [];
    }
}
