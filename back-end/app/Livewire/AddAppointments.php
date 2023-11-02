<?php

namespace App\Livewire;

use App\Http\Requests\Admin\PhoneNumberRequest;
use App\Traits\QueryCommon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddAppointments extends Component
{
    use QueryCommon;
    public $phone;
    public $search_phone;
    public $modalOpen = false;
    public $doctor_id;
    public function render()
    {
        $data = $this->tableQuery('users')->select('id' , 'name' , 'phone')
            ->where('role_id' , '=' , 4)
            ->get();
        $dataDoctor = $this->tableSelectCommon('doctors')->get();
        $dataService = $this->tableSelectCommon('services')->get();
        $dataTypePet = $this->tableSelectCommon('type_pets')->get();
        return view('livewire.add-appointments' , compact('data' , 'dataDoctor'
            , 'dataService' , 'dataTypePet'));
    }

    public function addAppointment() {
        $this->validatePhone();
        $this->search_phone = $this->tableQuery('users')
            ->where('phone', $this->phone)
            ->select('name' , 'id' , 'phone' , 'email')->first();
    }

    public function StoreAppointments() {
        $rules = [
            'doctor_id' => 'required',
        ];
        $customMessages = [
            'doctor_id.required' => 'Trường số điện thoại là bắt buộc.',
        ];
        $validate = $this->validate($rules, $customMessages);
        if(!$validate) {
            Session::flash('success', 'Gửi đi thông báo thành công');
            $this->closeModal();
        }
    }

    public function openModal() {
        $this->modalOpen = true;
    }

    public function closeModal() {
        $this->modalOpen = false;
    }

    public function clearForm() {
        $this->phone = '';
        $this->search_phone = null;
    }
}
