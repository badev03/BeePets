<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;

class DoctorUserController extends BaseResponseApiController
{
    use QueryCommon;

    public function index()
    {
        $doctors = $this->tableQuery('doctors')->get();

        $reviewAverages = Review::select('doctor_id', \DB::raw('AVG(score) as average_score') , \DB::raw('COUNT(*) as review_count'))
            ->groupBy('doctor_id')
            ->get();
        $reviewAveragesArray = [];
        $reviewCount = [];
        foreach ($reviewAverages as $reviewAverage) {
            $reviewAveragesArray[$reviewAverage->doctor_id] = $reviewAverage->average_score;
            $reviewCount[$reviewAverage->doctor_id] = $reviewAverage->review_count;
        }
        foreach ($doctors as $doctor) {
            $doctor_id = $doctor->id;
            $doctor->average_score = isset($reviewAveragesArray[$doctor_id]) ? $reviewAveragesArray[$doctor_id] : null;
            $doctor->review_count = isset($reviewCount[$doctor_id]) ? $reviewCount[$doctor_id] : null;
        }
        if($doctors) {
            return response()->json([
                'doctor' => $doctors ,
                'msg' => 'oke dữ liệu thành công'
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'no data'
            ] , 400);
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
