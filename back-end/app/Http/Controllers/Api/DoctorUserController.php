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
        $reviews = $this->tableQuery('reviews')->where('doctor_id' , '=' , $id)->get();
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
