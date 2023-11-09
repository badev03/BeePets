<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PhoneNumberRequest extends FormRequest
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
            'phone' => 'required|numeric|max:10'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.numeric' => 'Trường số điện thoại phải là số.',
            'phone.max' => 'Trường số điện thoại không được vượt quá 10 ký tự.',
        ];
    }
}
