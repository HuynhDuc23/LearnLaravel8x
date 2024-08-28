<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Phone;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $users;
    const _PER_PAGE = 3;
    function __construct()
    {
        $this->users = new Users();
    }
    public function index(Request $request)
    {
        $filters = [];
        $keywords = null;
        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }

            $filters[] = [
                'users.status',
                '=',
                $status
            ];
        }


        if (!empty($request->group_id)) {
            $group_id = $request->group_id;
            $filters[] = [
                'users.id_group',
                '=',
                $group_id
            ];
            // mang long mang
        }
        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }



        $title =  'List Data People';

        // xu ly logic loc du lieu sap xep
        $sortType = $request->input('sort-type');


        $sortBy = $request->input('sort-by');

        $arrName = [
            'name'
        ];

        if (!empty($sortBy) && in_array($sortBy, $arrName)) {
            $sortBy = $request->input('sort-by');
        } else {
            $sortBy = 'name';
        }

        $allowArray = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowArray)) {
            if ($sortType == 'asc') {
                $sortType = 'desc';
            } else {
                $sortType = 'asc';
            }
        } else {
            $sortType = 'asc';
        }

        $arrSort = [
            'sort-by' => $sortBy,
            'sort-type' => $sortType,
        ];
        $users = $this->users->getAllUsers($filters, $keywords, $arrSort, self::_PER_PAGE);

        $users->withQueryString(); // luu lai query string tren url

        $msg = $users->isEmpty() ? 'Không tìm thấy dữ liệu cần tìm' : 'Dữ liệu tìm thành công !';

        return view('clients.users_.lists', compact('title', 'users', 'sortType'))->with('msg1', $msg);
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
                'name' => $request->name,
                'email' => $request->email,
                'created_at' => $time
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
            if (!empty($userDetail)) {
                $userDetail = $userDetail;
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
                    'name' => $request->name,
                    'email' => $request->email,
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
                $userDetail = $userDetail;
                $this->users->deleteUser($id);
            } else {
                return redirect()->route('user.index')->with('msg', 'không tồn tại dữ liệu');
            }
        } else {
            return redirect()->route('user.index')->with('msg', 'không tồn tại id');
        }
        return redirect()->route('user.index')->with('msg', 'Đã xoá thành công ');
    }
    public function relations(Request $request)
    {

        $id = $request->id;
        // $phoneObject = Users::find($id)->phone;
        // if (!empty($phoneObject)) {
        //     dd($phoneObject);
        // } else {
        //     dd('Null');
        // }
        // $userObject = Phone::where('name', '0915620615')->first()->user;
        // if (!empty($userObject)) {
        //     dd($userObject->name);
        // } else {
        //     dd('Null');
        // }

        // $userobject = Users::find($id)->group;
        // dd($userobject);
        // if (!empty($userobject)) {
        //     dd($userobject->name);
        // } else {
        //     dd('Null');
        // }

        $users = Groups::find($id)->users;

        dd($users);
        foreach ($users as $user) {
            echo $user->name . $user->email . "</br>";
        }
    }
}
