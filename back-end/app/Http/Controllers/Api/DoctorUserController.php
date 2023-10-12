<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;

class DoctorUserController extends BaseResponseApiController
{
    use QueryCommon;

    public function index()
    {
        $doctor = $this->tableQuery('doctors')
            ->get();
        if($doctor) {
            return response()->json([
                'doctor' => $doctor ,
                'msg' => 'oke dữ liệu thành công'
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'no data'
            ] , 200);
        }
    }

    public function show($id) {
        $doctor = $this->tableQuery('doctors')->where('id' , '=' , $id)
            ->first();
        $reviews = $this->tableQuery('reviews')
            ->join('users' , 'users.id' , '=' , 'reviews.user_id')
            ->join('doctors' , 'doctors.id' , '=' , 'reviews.doctor_id')
            ->select('reviews.*' , 'users.name as user_name' , 'users.avatar'
                 , 'users.id as users_id')
            ->where('users.role_id' , '=' , 4)
            ->where('doctor_id' , '=' , $id)
            ->get();
        if($doctor) {
            return response()->json([
                'doctor' => $doctor ,
                'reviews' => $reviews,
                'msg' => 'oke dữ liệu thành công'
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'no data'
            ] , 200);
        }
    }
}
