<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Rules\UpperCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public $data = [];
    public function product()
    {
        $this->data['title'] = 'Valiation ';
        $this->data['error'] = 'Vui lòng kiểm tra dữ liệu nhập vào';
        return view('clients.products.index', $this->data);
    }
    public function add(Request $request)
    {
        $rules = [
            'email' => ['required', 'min:6'],
            'password' => ['required', 'min:6', new UpperCase],
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute phaỉ nhỏ hơn :min kí tự'
        ];
        $attributes = [
            'email' => 'Thư điện tử',
            'password' => 'Mật khẩu'
        ];


        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->errors()->add('msg', 'Vui lòng kiểm tra dữ liệu');
            // không bị chuyển hưởng trang
        } else {
            return redirect()->route('get-san-pham')->with('msg', 'Validation thành công');
            // chuyển hướng trang
        }
        return back()->withErrors($validator);

        // $rules = [
        //     'email' => 'required|min:6',
        //     'password' => 'required|min:6'
        // ];
        // $messages = [
        //     'required' => 'Truoừng :attribute bắt buộc phải nhập',
        //     'min' => 'Trường :attribute bắt buộc phải lơn hơn :min ký tự',
        // ];

        // $request->validate($rules, $messages);
        // xử lý lưu vào database
    }
    public function get()
    {
        return view('clients.products.get');
    }
}
