<?php

namespace App\Http\Controllers\Api;

use \App\Http\Controllers\Api\BaseResponseApiController;
use App\Http\Controllers\Controller;
use App\Models\Newc;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewController extends BaseResponseApiController
{
    use QueryCommon;
    public $model = Newc::class;
    public $title = 'Tin tức ';

    public function query() {
        $query = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date'
                , 'new_categories.name as nameCategories')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status', '=', 1)
            ->orderBy('newcs.created_at', 'desc');
        return $query;
    }
    public function index()
    {
        $data = $this->query()
            ->paginate(4);
        if($data->isEmpty()) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function showNew() {
        $data = $this->query()
            ->limit(3)->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        return response()->json([
            'new'=>$data
        ] , '200');
    }

    public function postNew($name=null) {
        $query = $this->query();
        if($name) {
            $data = $query->where('newcs.name', 'like', '%'.$name.'%')->get();
        }
        else {
            $data = $query->limit(5)->get();
        }
        if($data->isEmpty()) {
            return response()->json(['message' => $this->title.'không có dữ liệu'], 404);
        }
        else {
            return response()->json([
                'new'=>$data
            ] , '200');
        }
    }

    public function categoriesNew() {
        $categoriesNew = $this->tableQuery('new_categories')
            ->select('new_categories.id', 'new_categories.name')
            ->where('new_categories.status', '=', 1)
            ->get();
        if($categoriesNew->isEmpty()) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        $data = [];
        foreach ($categoriesNew as $category) {
            $newItems = $this->query()
                ->where('newcs.new_categorie_id', $category->id)
                ->get();
            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'new' => $newItems,
            ];
        }
        return response()->json([
            'categoriesNew'=> $data
        ] , '200');
    }

    public function show(string $slug) {
        $data = $this->query()
            ->where('newcs.slug', '=', $slug)
            ->first();
        if(!$data) {
            return response()->json(['message' => $this->title.'không có dữ liệu'], 404);
        }
        $relatedNew = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->get();
        return response()->json([
            'newDetail' => $data ,
            'new-related' => $relatedNew
        ],
            '200');
    }

    public function postNewShow(string $id) {
        $data = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name', 'newcs.slug', 'newcs.content' , 'newcs.image' , 'newcs.public_date'
                , 'new_categories.name as nameCategories')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->where('new_categories.status', '=', 1)
            ->where('newcs.id', '=', $id)
            ->first();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
        $relatedNew = $this->tableQuery('newcs')
            ->select('newcs.id', 'newcs.name')
            ->join('new_categories' , 'new_categories.id' , '=' , 'newcs.new_categorie_id')
            ->get();
        return response()->json([
            'newDetail' => $data ,
        ],
            '200');
    }
}
