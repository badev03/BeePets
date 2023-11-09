<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait QueryCommon {
    public function tableQuery($table) {
        $query = DB::table($table);
        return $query;
    }

    /**
     * @return string
     */
    public function getTimestampQuery()
    {
        $times = now()->format('Y-m-d H:i:s');
        return $times;
    }

    public function createUserAuto($phone_number) {
        $insert_user = $this->tableQuery('users')->insertGetId(
            [
                'name' => $phone_number,
                'phone' => $phone_number,
                'email' => $phone_number.'@gmail.com',
                'password' => Hash::make($phone_number),
                'status' => 1,
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        return $insert_user;
    }

    public function checkPhone($data) {
        $checkPhone = $this->tableQuery('users')
            ->where('role_id' , '=' , 4)
            ->where('phone' , '=' , $data)
            ->first();
        return $checkPhone;
    }

    public function checkPhoneAppointments($data) {
        $checkPhone = $this->tableQuery('users')
            ->where('phone' , '=' , $data)
            ->first();
        return $checkPhone;
    }

    public function checkIdAppointment($id) {
        $checkPhone = $this->tableQuery('users')
            ->where('id' , '=' , $id)
            ->first();
        return $checkPhone;
    }

    public function queryCommon() {
        $query = DB::table('appointments')
            ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'appointments.date' , 'appointments.id'
                , 'doctors.name as doctor_id' , 'users.name as user_id', 'users.id as id_user',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.shift_name',
                'appointments.doctor_id as id_doctor');
        return $query;
    }

    public function dataAppointent() {
        $data = [
            'time' =>now(),
            'created_at' => $this->getTimestampQuery(),
            'updated_at' => $this->getTimestampQuery(),
        ];
        return $data;
    }


    public function validatePhone() {
        $rules = [
            'phone' => 'required|numeric',
        ];
        $customMessages = [
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.numeric' => 'Trường số điện thoại phải là số.',
        ];
        $this->validate($rules, $customMessages);
    }

    public function appointmentsCommon() {
        $dataDoctor = $this->tableSelectCommon('doctors')->get();
        $dataService = $this->tableSelectCommon('services')->get();
        $dataTypePet = $this->tableSelectCommon('type_pets')->get();

        return [
            'dataDoctor' => $dataDoctor,
            'dataService' => $dataService,
            'dataTypePet' => $dataTypePet,
        ];
    }

    public function tableSelectCommon($table) {
        $query = DB::table($table)->select('id' , 'name');
        return $query;
    }
}
