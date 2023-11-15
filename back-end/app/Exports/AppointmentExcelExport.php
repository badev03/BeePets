<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AppointmentExcelExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $appointments = Appointment::join('users' , 'users.id' , '=' , 'appointments.user_id')
            ->select('appointments.id' , 'appointments.status' , 'appointments.description' ,
                'appointments.shift_name' ,
                'users.name as nameUser'
                , 'users.phone as phoneUser' ,'appointments.date')
            ->get();
        return $appointments;
    }

    public function title(): string
    {
        return 'Appointments';
    }

    public function headings(): array
    {
        return [
            'id',
            'Trạng thái',
            'Ghi chú',
            'Ca khám',
            'Tên chủ thú cưng',
            'Số điện thoại chủ thú cưng',
            'Bác sĩ',
            'Tên dịch vụ sử dụng',
            'Ngày khám bệnh',
        ];
    }
}
