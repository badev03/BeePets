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
   
    $selectedDoctors = $request->input('doctor_id');
    $date = $request->input('date');
    $shifts = $request->input('shift_name');

    $shiftData = [];

    foreach ($selectedDoctors as $doctorId) {
        foreach ($shifts as $shift) {
            switch ($shift) {
                case 'Ca 1':
                    $shiftData[] = [
                        'date' => $date,
                        'shift_name' => $shift,
                        'start_time' => '08:00:00',
                        'end_time' => '12:00:00',
                        'doctor_id' => $doctorId,
                    ];
                    break;

                case 'Ca 2':
                    $shiftData[] = [
                        'date' => $date,
                        'shift_name' => $shift,
                        'start_time' => '13:00:00',
                        'end_time' => '17:00:00',
                        'doctor_id' => $doctorId,
                    ];
                    break;

                case 'Ca 3':
                    $shiftData[] = [
                        'date' => $date,
                        'shift_name' => $shift,
                        'start_time' => '18:00:00',
                        'end_time' => '20:00:00',
                        'doctor_id' => $doctorId,
                    ];
                    break;
            }
        }
    }

    Work_schedule::insert($shiftData);

    return redirect()->route('schedules.index');
}
    public function destroy($id)
    {
        $schedule = Work_schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index');
    }

    public function edit($id)
    {
        $schedule = Work_schedule::findOrFail($id);
        $doctor_id = $schedule->doctor_id;
        $doctors = Doctor::all(['id', 'name']);
        return view('admin.schedules.edit', compact('schedule', 'doctors'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
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
            ]
        );
        $schedule = Work_schedule::findOrFail($id);
        $schedule->fill($request->except('doctor_id'));
        $schedule->doctor_id = $request->doctor_id[0];
        $schedule->save();
        return redirect()->route('schedules.index');
    }
    }

