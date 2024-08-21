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
    public function getEdit(Request $request, $id)
    {
        $title = 'Cập nhật người dùng';
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {
                $userDetail = $userDetail[0];
                $request->session()->put('id', $id);
            } else {
                return redirect()->route('user.index')->with('msg', 'Không tìm thấy người dùng');
            }
        } else {
            return redirect()->route('user.index')->with('msg', 'Không tìm thấy người dùng');
        }
        return view('clients.users_.edit', compact('title', 'userDetail'));
    }
    public function postEdit(Request $request)
    {
        $id = $request->session()->get('id');
        if (!empty($id)) {
            $rules = [
                'name' => 'required|min:6',
                'email' => 'required|unique:users,email,' . $id, // check email chính nó thì không sao và check các email phải duy nhất trong db
            ];
            $messages = [
                'name.required' => 'Tên vui lòng bắt buộc nhập',
                'name.min' => 'Tên cần tối thiểu :min ký tự',
                'email.required' => 'Thư điện tử bắt buộc phải nhập',
                'email.unique' => 'Thư điện tử phải là duy nhất     '
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = [
                    $request->name,
                    $request->email,
                ];
                $this->users->updateUser($id, $data);
            }
        } else {
            return redirect()->route('user.index')->with('msg', 'Không tìm thấy người dùng');
        }
        return redirect()->route('user.index')->with('msg', 'Cập nhật thành công');
    }
    public function delete($id)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)) {
                $userDetail = $userDetail[0];
                $this->users->deleteUser($id);
            } else {
                return redirect()->route('user.index')->with('msg', 'không tồn tại dữ liệu');
            }
        } else {
            return redirect()->route('user.index')->with('msg', 'không tồn tại id');
        }
        return redirect()->route('user.index')->with('msg', 'Đã xoá thành công ');
    }
}
