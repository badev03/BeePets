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
}
