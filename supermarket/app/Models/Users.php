<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected  $table = "users";
    use HasFactory;

    public function getAllUsers($filters = [], $keywords = null)
    {
        $data = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.id_group', '=', 'groups.id')
            ->orderBy('users.created_at', 'desc');

        if (!empty($filters)) {
            $data = $data->where($filters);
        }
        // Lưu ý: get() nên được gọi sau khi tất cả các điều kiện đã được áp dụng.
        if (!empty($keywords)) {
            $data = $data->where('users.name', 'like', '%' . $keywords . '%');
            $data = $data->orWhere('users.email', 'like', '%' . $keywords . '%');
        }


        return $data->get();
    }
    public function postUsers($data)
    {

        $data = DB::table($this->table)->insert($data);
        return $data;
        // return DB::insert('INSERT INTO users (name, email , created_at) VALUES( ?, ?,?)', $data);
    }
    public function getDetail($id)
    {

        $data =  DB::table($this->table)->where('id', $id)->first();
        // object
        return $data;
        //return DB::select('SELECT * FROM users WHERE id =?', [$id]);
    }
    public function updateUser($id, $data)
    {
        //$data = array_merge($data, [$id]);

        return DB::table($this->table)->where('id', $id)->update(
            [
                'name' => $data['name'],
                'email' => $data['email'],
            ]
        );
        // return DB::update('UPDATE users SET name =?, email =? WHERE id =?', $data);
    }
    public function deleteUser($id)
    {
        //return DB::delete('DELETE FROM users WHERE id =?', [$id]);

        return DB::table($this->table)->where('id', $id)->delete();
    }
    public function stastement()
    {
        return DB::statement('SELECT * FROM users');
        // boolean
    }

    // query builder lấy toán bộ dữ liệu
    public function learnQueryBuilder()
    {
        //$data = DB::table($this->table)->get();
        // lay ra tat cac cac dong
        // thu tu : table -> truoc sau khong quan trong phan o giua -> cuoi dung get hoac first() : khi muon lay ra dong dau tien
        //$data = DB::table($this->table)->select('name', 'email')->get();

        //$data = DB::table($this->table)->select('name', 'email')->where('email', '=', 'admin@gmail.com')
        //   ->get();
        //$data = DB::table('users')->select('name', 'email')->first();

        //$data = DB::table($this->table)->select('name', 'email')->where('created_at', '<', '2024-07-22')->get();

        //$data = DB::table($this->table)->select('name', 'email')->where('email', '<>', 'ductra')->first();

        // $data = DB::table($this->table)->select('name', 'email')->where(
        //     [
        //         ['name', '<>', 'LapTopShop'],
        //         ['email', '<>', 'ductrantad23@gmail.com'],
        //     ]
        // )->first();
        // $data = DB::table($this->table)->select('name', 'email')->where('name', '=', 'LapTopShop')->orWhere('email', '=', 'admin@gmail.com')->get();
        // ($data->toSql());

        //$data = DB::table('groups')->select('name', 'id')->whereIn('name', ['Admin', 'User'])->get();

        // $data = DB::table($this->table)->select('name', 'email')->whereNotNull('id_group')->get();

        // if (!empty($data)) {
        //     dd($data->count());
        // }
        //$data = DB::table($this->table)->whereNull('id_group')->get();
        // whereDate : whereDay , whereMonth , whereYear

        //$data = DB::table($this->table)->select('name', 'email')->whereColumn('name', '>', 'email')->get();

        // join

        //$data =  DB::table($this->table)->join('groups', 'users.id_group', '=', 'groups.id')->select('users.*')->get();
        // left join , right join

        // sap xep 1 cot

        //$data =  DB::table('users')->orderBy('id', 'desc')->get();
        // sap xep theo nhieu cot

        //$data = DB::table('users')->select('name', 'id')->orderBy('id', 'desc')->orderBy('email', 'desc')->get();

        // sap xep random

        //$data =  DB::table($this->table)->select('id')->inRandomOrder()->get();


        // $dataInsert = [
        //     'name' => 'TranVuHuynhDuc',
        //     'email' => 'ductrantad23@gmail.com',
        //     'created_at' => date('Y-m-d H:i:s'),
        // ];
        // $data = DB::table($this->table)->insert($dataInsert);
        // if ($data == true) {
        //     dd($data);
        // }
        // them nhieu bang ghi mot luc

        // $dataInsert = [
        //     [
        //         'name' => 'TranVuHuynhDuc',
        //         'email' => 'ductrantad23@gmail.com',
        //         'created_at' => date('Y-m-d H:i:s'),
        //     ],
        //     [
        //         'name' => 'TranVuHuynhDuc',
        //         'email' => 'ductrantad23@gmail.com',
        //         'created_at' => date('Y-m-d H:i:s'),
        //     ],

        // ];
        // $data = DB::table($this->table)->insert($dataInsert);
        // if ($data == true) {
        //     dd($data); // true of false
        // }

        // $data = DB::table($this->table)->where('id', 10)->delete();
        // dd($data); -> row delete

        $dataUpdate = [
            'name' => 'TranVuHuynhDucUpdate',
        ];
        $data = DB::table($this->table)->where('id', 9)->update($dataUpdate);
        dd($data); // so dong update


        // DB raw () : chep phep nguoi dung su dung sql thuan khi truy van

    }
}
