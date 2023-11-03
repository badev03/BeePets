<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = \App\Models\About::where('status', 1)->first();
        return response()->json([
            'status' => 200,
            'data' => $about
        ]);
    }
}
