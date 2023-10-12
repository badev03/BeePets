<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'service_id' => 'required',
            'doctor_id' => 'required',
            'date' => 'required',
            'shift_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Trường mô tả không được để trống',
            'service_id.required' => 'Trường dịch vụ không được để trống',
            'doctor_id.required' => 'Trường Bác sĩ không được để trống',
            'date.required' => 'Trường ngày đặt không được để trống',
            'shift_name.required' => 'Trường ca đặt không được để trống',
        ];
    }
}
