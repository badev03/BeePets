<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('admin.dashboard.dashboard');
    }

    public function uploadImg(Request $request) {
        if($request->has('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName , PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'_'.time().'_'.$extension;
            $request->file('upload')->move(public_path('media') , $fileName);
            $url = asset('media/'. $fileName);
            return response()->json([
                'fileName' => $fileName , 'uploaded' => 1, 'url' => $url
            ]);
        }
    }
}
