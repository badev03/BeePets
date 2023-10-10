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

        $doctor_id = $request->input('doctor_id', 1);
        $date = $request->input('date');
        $workSchedule = Work_schedule::where('doctor_id', $doctor_id)
            ->where('date', $date)->get();

        if ($workSchedule->isEmpty()) {
            return redirect()->back()->with('errors', 'Không có lịch làm việc cho ngày đã chọn');
        }

        $now = Carbon::now();
        $now->addHours(7); // Cộng thêm 7 giờ (nếu cần)
        $now->format('Y-m-d H:i:s');

        foreach ($workSchedule as $item) {
            $end_time = Carbon::parse($item->end_time);
            if ($now->greaterThanOrEqualTo($end_time)) {

                //   hiển thị thông báo lỗi
                return redirect()->route('index')->with('errors', 'Thời gian hiện tại vượt quá thời gian của ca 1');
            }
        }

        if (!auth()->check()) {
            $user = User::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'password' => bcrypt('123456'),
                'status' => 0,
            ]);
        } else if (auth()->user()->phone == $request->input('phone')) {
            return redirect()->route('index')->with('errors', 'trùng phone');
            
        } else {
            $user = auth()->user();
        }




        $model = new Appointment();
        $model->fill($request->all());
        $model->user_id = $user->id;
        $model->save();
        // hiển thị thông báo thành công

        return redirect()->route('index')->with('success', 'Đã tạo cuộc hẹn thành công');
    }
}
