<?php

namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Api\BaseResponseApiController;
use App\Http\Controllers\Controller;
use App\Models\Newc;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;

class NewController extends BaseResponseApiController
{
    use QueryCommon;
    public $model = Newc::class;
    public $title = 'Tin tức ';
    public function index()
    {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status' , '=' , 1)
            ->paginate(4);
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function showNew() {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status' , '=' , 1)
            ->limit(3)
            ->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function postNew() {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status', '=', 1)
            ->orderBy('newcs.created_at', 'desc')
            ->limit(5)
            ->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function categoriesNew() {
        $data = $this->tableQuery('new_categories')
            ->select('new_categories.id', 'new_categories.name')
            ->where('new_categories.status', '=', 1)
            ->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'categoriesNew'=>$data
        ] , '200');
    }

    public function searchNew($name) {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status', '=', 1)
            ->where('newcs.name', 'like', '%'.$name.'%')
            ->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function show(string $id) {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status', '=', 1)
            ->where('newcs.id', '=', $id)
            ->first();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }



}
