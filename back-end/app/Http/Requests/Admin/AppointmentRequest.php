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
        $currentAction = request()->route()->getActionMethod();
        $rule = [];
        switch ($currentAction) {
            case 'store' :
                $rule = [
                    'description' => 'required',
                    'service_id' => 'required|nullable',
                    'doctor_id' => 'required',
                    'date' => 'required',
                    'shift_name' => 'required',
                ];
                break;
            case 'update':
                $rule = [
                    'description' => 'required',
                    'service_id' => 'required|nullable',
                    'doctor_id' => 'required',
                    'date' => 'required',
                    'shift_name' => 'required',
                    'user_id' => 'required',
                ];
                break;
            default:
                break;
        }
        return $rule;
    }

    public function messages()
    {
        $currentAction = request()->route()->getActionMethod();
        $messages = [];
        switch ($currentAction) {
            case 'store' :
                $messages = [
                    'description.required' => 'Trường mô tả không được để trống',
                    'service_id.required' => 'Trường dịch vụ không được để trống',
                    'service_id.nullable' => 'Trường dịch vụ bắt buộc phải chọn',
                    'doctor_id.required' => 'Trường Bác sĩ không được để trống',
                    'date.required' => 'Trường ngày đặt không được để trống',
                    'shift_name.required' => 'Trường ca đặt không được để trống',
                ];
                break;
            case 'update':
                $messages = [
                    'description.required' => 'Trường mô tả không được để trống',
                    'service_id.required' => 'Trường dịch vụ không được để trống',
                    'service_id.nullable' => 'Trường dịch vụ bắt buộc phải chọn',
                    'doctor_id.required' => 'Trường Bác sĩ không được để trống',
                    'date.required' => 'Trường ngày đặt không được để trống',
                    'shift_name.required' => 'Trường ca đặt không được để trống',
                    'user_id.required' => 'Trường user đặt không được để trống',
                ];
                break;
            default:
                break;
        }
        return $messages;
    }
}
