<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class BladeController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['dataArr'] = [
            'Tran Vu Huynh Duc',
            'Pham Huu Thien',
            'Nguyen Da Da'
        ];
        $this->data['check'] = true;
        $this->data['message'] = '<h1> Hello!</h1>';
        $this->data['index'] = 0;
        return view('Blade', $this->data);
    }
    public function home()
    {
        $this->data['title'] = 'UNICODE-PAGE';
        return view('clients.home', $this->data);
    }
    public function products()
    {
        $this->data['title_products'] = 'UNICODE_PAGE_PRODUCT';
        return view('clients.product', $this->data);
    }
    public function getAdd()
    {
        $this->data['title'] = 'ADD PRODUCT';
        return view('clients.add', $this->data);
    }
    public function postAdd(Request $request)
    {
        $rules = [
            'name' => 'required|min:6',
        ];
        $messages = [
            'required' => ':attribute phải bắt buộc nhập',
            'min' => ':attribute :min phải có hơn 6 kí tự'
        ];

        $attributes = [
            'name' => 'Tên sản phẩm'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->errors()->add('msg', 'Vui lòng kiểm tra dữ liệu');
            // nó sẽ quay lại trang trước post là get , không redirect
        } else {
            dd($validator); // nếu validator thành công nó sẽ trả về một object
            return redirect()->route('adds')->with('msg', 'Sản Phẩm Thêm Thành công');
        }
        return back()->withErrors($validator);
    }
}
