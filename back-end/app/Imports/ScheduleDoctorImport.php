<?php

namespace App\Imports;

use Log;
use App\Models\Doctor;
use App\Models\Work_schedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ScheduleDoctorImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $data = [
                'date' => Date::excelToDateTimeObject($row['date'])->format('Y-m-d'),
                'shift_name' => $row['shift_name'],
                'start_time' => Carbon::createFromFormat('H', $row['start_time'])->toTimeString(),
                'end_time' => Carbon::createFromFormat('H', $row['end_time'])->toTimeString(),
                'doctor_id' => $row['doctor_id'],
            ];

            $doctor = Doctor::where('id', $data['doctor_id'])->first();

            $work_schedule = Work_schedule::where('doctor_id', $data['doctor_id'])->where('date', $data['date'])->first();
            if ($doctor && $work_schedule) {
                $work_schedule->update($data);
            } else if ($doctor) {
                Work_schedule::create($data);
            }
        }
    }

    public function rules(): array
    {
        return [
            'shift_name' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_id' => 'required|exists:doctors,id',

        ];
    }
    public function messages(): array
    {
        return [
            'shift_name.required' => 'Hãy nhập tên ca .',
            'date.required' => 'Hãy nhập ngày.',
            'doctor_id.required' => 'Hãy chọn bác sĩ.',
            'start_time.required' => 'Hãy nhập giờ bắt đầu.',
            'end_time.required' => 'Hãy nhập giờ kết thúc.',
            'doctor_id.exists' => 'Bác sĩ không tồn tại.',
            
      
        ];
    }
}
