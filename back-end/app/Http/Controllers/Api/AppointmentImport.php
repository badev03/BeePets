<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Imports\AppointmentImports;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentImport extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $path = $request->file('file')->getRealPath();

        try {
            Excel::import(new AppointmentImports, $path);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed, return validation errors
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ]);
        } catch (\Exception $e) {
            // Other exceptions (e.g., unexpected errors)
            return response()->json([
                'status' => false,
                'message' => 'Import failed',
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Import success',
        ]);
    }
}
