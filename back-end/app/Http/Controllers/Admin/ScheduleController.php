<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Work_schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.schedules.index');
    }
    public function create()
    {
        //lấy ra tên và id của tất cả các bác sĩ
        $doctors = Doctor::all(['id', 'name']);
        return view('admin.schedules.create', compact('doctors'));
    }


    public function store(Request $request)
    {
    //    dd($request->all());
        
        $schedules = new Work_schedule([
            'date' => $request->input('date'),
            'slot_time' => $request->input('slot_time'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'doctor_id' => $request->input('doctor_id'),
            
        ]);
        $schedules->save();
  
        }

    }

