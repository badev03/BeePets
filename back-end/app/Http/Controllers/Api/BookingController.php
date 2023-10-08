<?php

namespace App\Http\Controllers\Api;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Work_schedule;
use App\Models\User;
use App\Models\Type_pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BookingController extends Controller
{
    public function showForm(Request $request)
    {
        $this->validate($request, [
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i:s',
            'shift_name' => 'required',
            'type_pet_id' => 'required|exists:type_pets,id',
            'service_id' => 'required|exists:services,id',

        ]);
        $service = Service::all();
        $typePets = Type_pet::all();
        $doctors = Doctor::all();

        $doctor_id = $request->input('doctor_id', 1);
        $date = $request->input('date');

        $workSchedule = Work_schedule::where('doctor_id', $doctor_id)
            ->where('date', $date)->get();

        if ($workSchedule->count() > 0) {
            return response()->json(compact('service', 'typePets', 'doctors', 'workSchedule'));
        } else {
            return response()->json(['message' => 'Không có lịch làm việc'], 404);
        }
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

        return response()->json(['message' => 'Đã tạo cuộc hẹn thành công'], 201);
    }
}







