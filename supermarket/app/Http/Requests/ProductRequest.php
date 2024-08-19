<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // access user excute request ?
        return false;
        // muốn thay đổi dòng text mặc định của laravel ?
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
    public function messages(): array
    {
        return [
            'email.required' => ':attribute bắt buộc phải nhập',
            'email.min' => ':attribute bắt buộc phải lớn hơn :min',
            'password.required' => ':attribute bắt buộc phải nhập',
            'password.min' => ':attribute bắt buộc phải lớn hơn :min',
        ];
    }
    // option
    public function attributes(): array
    {
        return [
            'email' => 'Thư điện tử',
            'password' => 'mật khẩu',
        ];
    }

    // Sau khi validation
    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()) {
                $validator->errors()->add('msg', 'Đã có lỗi vui lòng kiểm tra lại');
            }
        });
        // sau khi validation xong thì cho dù đúng hay sai thì nó cũng chạy xuống
    }
    // trước khi validation
    protected function prepareForValidation(): void
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s')
        ]);
    }
    protected function failedAuthorization()
    {
        //throw new AuthorizationException('Bạn đang truy cập vào khu vực cấm');
        //muốn thay đổi dòng text mặc định của laravel
        // ghi đè lại core laravel

        // trường hợp muốn chuyển hướng chứ không muốn quen ra 403 : HttpResponseException
        //throw new HttpResponseException(redirect('/home')->with('msg' . 'Đã có lỗi xảy ra'));

        // chuyển hướng về 404 trong errors , nó sẽ ghi đè
        throw new HttpResponseException(abort(404));
    }

    // trường hợp muốn chuyển hướng chứ không muốn quen ra 403 : HttpResponseException



    // cách 3 trong validation sử dụng lớp : Validator : Laravel cung cấp sẵn class Validator , bạn có thể sử dụng class này để
    // Validation dữ liệu

}
