<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $users;
    function __construct()
    {
        $this->users = new Users();
    }
    public function index()
    {
        $users = DB::select('SELECT * FROM users ORDER BY created_at DESC');
        $title =  'Danh Sach San Pham';
        return view('clients.users_.lists', compact('title', 'users'));
    }
    public function get()
    {
        $title = 'Trang Them San Pham';

        return view('clients.users_.get', compact('title'));
    }
    public function post(Request $request)
    {
        $rules = [
            'name' => 'required|min:6',
            'email' => 'required|unique:users',
        ];
        $messages = [
            'name.required' => 'Tên vui lòng bắt buộc nhập',
            'name.min' => 'Tên cần tối thiểu :min ký tự',
            'email.required' => 'Thư điện tử bắt buộc phải nhập',
            'email.unique' => 'Thư điện tử phải là duy nhất     '
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('msg', 'vui lòng kiểm tra dữ liệu');
            // withinput() -> để lưu được giá trị cũ trước đó
        } else {
            // insert data
            $time = date('Y-m-d H:i:s');
            $data = [
                $request->name,
                $request->email,
                $time
            ];
            $this->users->postUsers($data);
            return redirect()->route('user.index')->with('success', 'Dữ liệu đã được valiadion và thêm mới');
        }
    }
}
