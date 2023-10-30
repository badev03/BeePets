<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\Doctor;
use App\Models\Review;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorUserController extends BaseResponseApiController
{
    use QueryCommon;

    public function index()
    {
        $doctors = $this->QueryDoctorIndex();
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

    public function show($slug) {
        $doctor = $this->tableQuery('doctors')->where('slug' , '=' , $slug)
            ->first();
        $reviewAverages = Review::select('doctor_id', \DB::raw('AVG(score) as average_score') , \DB::raw('COUNT(*) as review_count'))
            ->where('doctor_id' , '=' , $doctor->id)
            ->groupBy('doctor_id')
            ->get();
        $reviewAveragesArray = [];
        $reviewCount = [];
        foreach ($reviewAverages as $reviewAverage) {
            $reviewAveragesArray[$reviewAverage->doctor_id] = $reviewAverage->average_score;
            $reviewCount[$reviewAverage->doctor_id] = $reviewAverage->review_count;
        }
        $doctor->average_score = $reviewAveragesArray[$doctor->id] ?? 0;
        $doctor->review_count = $reviewCount[$doctor->id] ?? 0;
        $reviews = $this->tableQuery('reviews')
            ->join('users' , 'users.id' , '=' , 'reviews.user_id')
            ->join('doctors' , 'doctors.id' , '=' , 'reviews.doctor_id')
            ->select('reviews.*' , 'users.name as user_name' , 'users.avatar'
                 , 'users.id as users_id')
            ->where('users.role_id' , '=' , 4)
            ->where('doctor_id' , '=' , $doctor->id)
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

    public function DoctorHomeUser()
{
    $doctors = $this->QueryDoctorIndex();

    if($doctors) {
        // Sắp xếp mảng theo trường review_count và average_score
        $sortedDoctors = $doctors->sortByDesc(function ($doctor, $key) {
            return [$doctor->review_count, $doctor->average_score];
        })->values()->take(4);

        return response()->json([
            'doctor' => $sortedDoctors ,
            'msg' => 'Lấy dữ liệu thành công'
        ] , 200);
    } else {
        return response()->json([
            'msg' => 'Không có dữ liệu'
        ] , 400);
    }
}




    public function QueryDoctorIndex() {
        $doctors = $this->tableQuery('doctors')->select('doctors.id','name','slug','doctors.image','address','description')
            ->get();

        $reviewAverages = Review::select('doctor_id', \DB::raw('AVG(score) as average_score') , \DB::raw('COUNT(*) as review_count'))
            ->groupBy('doctor_id')
            ->get();

        $imagesDoctor = $this->tableQuery('doctor_images')->select('id' , 'doctor_id' , 'image_path')->get();
        $reviewAveragesArray = [];
        $reviewCount = [];
        foreach ($reviewAverages as $reviewAverage) {
            $reviewAveragesArray[$reviewAverage->doctor_id] = $reviewAverage->average_score;
            $reviewCount[$reviewAverage->doctor_id] = $reviewAverage->review_count;
        }
        foreach ($doctors as $doctor) {
            $doctor_id = $doctor->id;
            $doctor->average_score = isset($reviewAveragesArray[$doctor_id]) ? $reviewAveragesArray[$doctor_id] : 0;
            $doctor->review_count = isset($reviewCount[$doctor_id]) ? $reviewCount[$doctor_id] : 0;
            $doctor->images = $imagesDoctor->where('doctor_id' ,$doctor->id )->pluck('image_path')->toArray();
        }
        return $doctors;
    }
}
