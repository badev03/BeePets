<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\Appointment;
use App\Models\Work_schedule;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;

// class AppointmentImport implements ToModel
// {

    // public function headingRow(): int
    // {
    //     return 1;
    // }
    // public function model(array $row)
    // {
        
    //     if ($row[0] === 'shift_name') {
    //         return null;
    //     }
    
    //     if (isset($row[1])) {
    //         $date = is_numeric($row[1]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])->format('Y-m-d') : null;
    //     }



    //     $now = Carbon::now();

    //     $work_schedule = Work_schedule::where('doctor_id', $row[5])->where('date', $date)->where('date', $date)->where(function ($query) use ($now) {
    //         $query->where('date', '>', $now->toDateString())
    //             ->orWhere(function ($q) use ($now) {
    //                 $q->where('date', $now->toDateString())
    //                     ->where('end_time', '>', $now->toTimeString());
    //             });
    //     })->first();;
    //     dd($work_schedule);
    //     $service = Service::where('id', $row[3])->first();
    //     $user = User::where('id', $row[4])->first();
    //     $type_pet = Type_pet::where('id', $row[2])->first();

    //     if ($work_schedule && $service && $user && $type_pet) {
    //         return new Appointment([
    //             'shift_name' => $row[0],
    //             'date' => $date, 
    //             'type_pet_id' => $row[2],
    //             'service_id' => $row[3],
    //             'user_id' =>  $row[4],
    //             'doctor_id' =>  $row[5],
    //             'status' =>  $row[6],
    //             'description' =>  $row[7]
    //         ]);
    //     } else {
          
    //         $this->abortImport("Invalid data in row: " . implode(', ', $row));
    //     }
    // }
    // private function abortImport($message)
    // {
    //     throw ValidationException::withMessages(['error' => $message]);
    // }
// }
