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

        $sevices = Service::all();
        return view('client.index', compact('sevices'));
    }
    public function saveInfo(Request $request)
    {
        $request->validate([
            'date'=>'required',
            'service_id'=>'required',
        ],
        [
            'date.required'=>'Vui lòng chọn ngày',
            'sevie_id.required'=>'Vui lòng chọn dịch vụ',]
    );

        $service = Service::all();
        $service_id = $request->service_id;
        $date = $request->date;
        $doctor_id = $request->input('doctor_id', 1);
        $doctor = Doctor::find($doctor_id);
        $doctors = Doctor::all();
        $typePets = Type_pet::all();





        $workSchedule = Work_schedule::where('doctor_id', $doctor_id)
        ->where('date', $date)
        ->first();


    if ($workSchedule) {
        $slotTime = $workSchedule->slot_time;

        // Chuyển đổi giờ và phút thành tổng số phút
        list($hours, $minutes, $seconds) = explode(':', $slotTime);
        $totalMinutes = ($hours * 60) + $minutes;

        $interval = new DateInterval('PT' . $totalMinutes . 'M');
    } else {
        echo('Không có lịch làm việc');
    }

        $schedules = $doctor->Work_schedule()->where('date', $date)->get();


        $scheduleData = [];
        foreach ($schedules as $workSchedule) {
            $startTime = Carbon::parse($workSchedule['start_time']);
            $endTime = Carbon::parse($workSchedule['end_time']);

            while ($startTime < $endTime) {
                $scheduleData[] = [
                    'start_time' => $startTime->format('H:i'),
                ];
                $startTime->add($interval);
            }
        }

        if ($request->input('name') == null && $request->input('phone') == null) {

            //lấy date và time đã có trong bảng appointment tương ứng với bác sĩ
            $appointments = Appointment::where('doctor_id', $doctor_id)->get();
            $times = [];
            foreach ($appointments as $appointment) {
                $times[] = [
                    'date' => $appointment->date,
                    'time' => $appointment->time,
                ];
            }



            return view('client.step2', compact('service_id', 'date', 'service', 'doctor', 'doctors', 'scheduleData', 'typePets','times'));

        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => bcrypt('123456'),
                'status' => 0,
            ]);
            $user_id = $user->id;


            $appointment = new Appointment([
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'time' => $request->input('start_time'),
                'type_pet_id' => $request->input('type_pet_id'),
                'service_id' => $request->input('service_id'),
                'doctor_id' => $request->input('doctor_id'),
                'user_id' => $user_id,
            ]);
            $appointment->save();
            //tạo thông báo ra màn hình
            return redirect()->route('index')->with('success', 'Đặt lịch thành công');
        }
    }
}
