<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\Appointment;
use App\Models\Work_schedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Support\ValidatedData;
use Maatwebsite\Excel\Concerns\WithValidation;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class AppointmentImports implements ToCollection, WithHeadingRow, WithValidation
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) {


            $data = [
                'shift_name' => $row['shift_name'],
                'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                'type_pet_id' => $row['type_pet_id'],
                'service_id' => $row['service_id'],
                'user_id' => $row['user_id'],
                'doctor_id' => $row['doctor_id'],
                'status' => $row['status'],
                'description' => $row['description'],

            ];
            $now = Carbon::now();

            $work_schedule = Work_schedule::where('doctor_id', $data['doctor_id'])->where('date', $data['date'])->where(function ($query) use ($now) {
                $query->where('date', '>', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->where('date', $now->toDateString())
                            ->where('end_time', '>', $now->toTimeString());
                    });
            })->first();

            $service = Service::where('id', $data['service_id'])->first();

            $user = User::where('id', $data['user_id'])->first();

            $type_pet = Type_pet::where('id', $data['type_pet_id'])->first();

            // kiểm tra các điều kiện như trên
            if ($work_schedule && $service && $user && $type_pet) {
                Appointment::create($data);
            }
        }
    }
    public function rules(): array
    {
        return [
            'shift_name' => 'required',
            'date' => 'required',
            'type_pet_id' => 'required',
            'service_id' => 'required',
            'user_id' => 'required',
            'doctor_id' => 'required',
            'status' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'shift_name.required' => 'Hãy nhập tên ca .',
            'date.required' => 'Hãy nhập ngày.',
            'type_pet_id.required' => 'Hãy chọn loại thú cưng.',
            'service_id.required' => 'Hãy chọn dịch vụ.',
            'user_id.required' => 'Hãy chọn người dùng.',
            'doctor_id.required' => 'Hãy chọn bác sĩ.',
            'status.required' => 'Hãy nhập trạng thái.',
        ];
    }
}
