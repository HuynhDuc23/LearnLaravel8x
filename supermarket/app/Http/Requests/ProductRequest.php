<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // access user excute request ?
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
            'email' => 'required|min:6',
            'password' => 'required|min:6'
        ];
    }
    // option
    public function messages()
    {
        return [
            'email.required' => ':attribute bắt buộc phải nhập',
            'email.min' => ':attribute bắt buộc phải lớn hơn :min',
            'password.required' => ':attribute bắt buộc phải nhập',
            'password.min' => ':attribute bắt buộc phải lớn hơn :min',
        ];
    }
    // option
    public function attributes()
    {
        return [
            'email' => 'Thư điện tử',
            'password' => 'mật khẩu',
        ];
    }
}
