<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AppointmentExcelExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;

class ExcelAppointmentController extends Controller
{
    public function excelAppointment() {
        return Excel::download(new AppointmentExcelExport(), 'appointments.xlsx');
    }

}