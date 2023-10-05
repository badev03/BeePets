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
        $schedules = Work_schedule::all();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        //lấy ra tên và id của tất cả các bác sĩ
        $doctors = Doctor::all(['id', 'name']);
        return view('admin.schedules.create', compact('doctors'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'slot_time' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_id' => 'required',
        ],
            [
                'date.required' => 'Vui lòng nhập ngày',
                'slot_time.required' => 'Vui lòng nhập slot time',
                'start_time.required' => 'Vui lòng nhập thời gian bắt đầu',
                'end_time.required' => 'Vui lòng nhập thời gian kết thúc',
                'doctor_id.required' => 'Vui lòng nhập bác sĩ',
        ]);
        $schedules = Work_schedule::all();
        foreach ($schedules as $key => $value) {
            if($value->date == $request->date && $value->doctor_id == $request->doctor_id){
                dd('Ngày này đã có lịch làm việc');
            }
        }


        $schedule = new Work_schedule();
        $schedule->fill($request->all());
        $schedule->save();
        return redirect()->route('schedules.index');
  
        }

        public function destroy($id)
    {
        $schedule = Work_schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index');
    }
    }

