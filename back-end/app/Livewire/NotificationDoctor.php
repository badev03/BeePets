<?php

namespace App\Livewire;

use App\Interfaces\MessageUser;
use App\Traits\QueryCommon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NotificationDoctor extends Component
{
    use QueryCommon;
    public $searchName;
    public $filteredUsers;
    public $searchRoles;
    public $notification;
    public $showMockup = true;
    public $messageUser;
    public function render()
    {
        $data = $this->query()->select('id' , 'name' , 'phone')->get();
        return view('livewire.notification-doctor' , compact('data'));
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
            $this->validate($rules, $customMessages);
            if($this->notification != null) {
                $data = $this->query()->select('id' , 'name')->get();
                foreach ($data as $key=>$item) {
                    $messageUser->sendManyDoctor($item->id , $this->messageUser);
                }
                Session::flash('success_message', 'Gửi đi thông báo thành công');
            }
        }
    }

    public function query() {
        $query = $this->tableQuery('doctors');
        return $query;
    }

    public function clearForm() {
        $this->messageUser = '';
        $this->notification = [];
    }

    public function clearFormSdt() {
        $this->searchName = '';
        $this->filteredUsers = $this->query()->select('id' , 'name' , 'phone')->get();
    }
}
