<?php

namespace App\Http\Controllers;

use DateInterval;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\Appointment;
use App\Models\Work_schedule;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
       
        return view('client.index');
    }

    public function showForm(Request $request)
    {


        $service = Service::all();
        $typePets = Type_pet::all();
        $doctors = Doctor::all();

        // lấy ra lịch làm việc của bác sĩ theo ngày
        $doctor_id = $request->input('doctor_id', 1);
        $date = $request->input('date');

        $workSchedule = Work_schedule::where('doctor_id', $doctor_id)
            ->where('date', $date)->get();



        if ($workSchedule) {
        } else {
            echo ('Không có lịch làm việc');
        }


        return view('client.form-book', compact('service', 'typePets', 'doctors', 'workSchedule'));
    }




    public function save(Request $request)
    {
        if (!auth()->check()) {
            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => bcrypt('123456'),
                'status' => 0,
            ]);
        } else {
            $user = auth()->user();
        }

        $model = new Appointment();
        $model->fill($request->all());
        $model->user_id = $user->id;
        $model->save();
    }


    //         $user = User::create([
    //             'name' => $request->input('name'),
    //             'phone' => $request->input('phone'),
    //             'password' => bcrypt('123456'),
    //             'status' => 0,
    //         ]);
    //         $user_id = $user->id;


    //         $appointment = new Appointment([
    //             'description' => $request->input('description'),
    //             'date' => $request->input('date'),
    //             'time' => $request->input('start_time'),
    //             'type_pet_id' => $request->input('type_pet_id'),
    //             'service_id' => $request->input('service_id'),
    //             'doctor_id' => $request->input('doctor_id'),
    //             'user_id' => $user_id,
    //         ]);
    //         $appointment->save();
    //         //tạo thông báo ra màn hình
    //         return redirect()->route('index')->with('success', 'Đặt lịch thành công');
    //     }
    // }
}
