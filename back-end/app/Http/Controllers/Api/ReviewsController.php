<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends BaseResponseApiController
{
    use QueryCommon;
    public $model = Review::class;

    public function index()
    {
        $data = $this->tableQuery('reviews')
            ->join('users' , 'users.id' , '=' , 'reviews.user_id')
            ->join('doctors' , 'doctors.id' , '=' , 'reviews.doctor_id')
            ->select('reviews.*' , 'users.name as user_id' , 'users.avatar' , 'doctors.name as doctor_id')
            ->where('users.role_id' , '=' , 4)
            ->get();
        return response()->json([
            'reviews' => $data],
            '200');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'user_id' => 'required',
            'contents' => 'required'
        ], [
            'doctor_id.required' => 'Trường bác sĩ không được để trống',
            'user_id.required' => 'Trường người đánh giá không được để trống',
            'contents.required' => 'Trường nội dung không được để trống'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $review = new Review([
            'doctor_id' => $request->doctor_id,
            'user_id' => $request->user_id,
            'content' => $request->contents,
            'score' => $request->score,
        ]);
        $storeReviews = $review->save();
        if($storeReviews) {
            return response()->json([
                'success' => true,
                'message' => 'Dữ liệu đã được lưu'
            ], 200);
        }
    }
}
