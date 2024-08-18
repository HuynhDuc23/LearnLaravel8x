<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{

    public $data = [];
    public function product()
    {
        $this->data['title'] = 'Valiation ';
        $this->data['error'] = 'Vui lòng kiểm tra dữ liệu nhập vào';
        return view('clients.products.index', $this->data);
    }
    public function add(ProductRequest $request)
    {
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
}
