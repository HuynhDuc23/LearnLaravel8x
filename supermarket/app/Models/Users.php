<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;

class Users extends Model
{
    protected  $table = "users";
    use HasFactory;

    public function phone()
    {
        return $this->hasOne(Phone::class, 'user_id', 'id');
    }
    public function group()
    {
        return $this->belongsTo(
            Groups::class,
            'id_group',
            'id'
        );
    }
    public function posts()
    {
        return $this->hasMany(
            Post::class,
            'user_id',
            'id'
        );
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function getAllUsers($filters = [], $keywords = null, $arrSort = null, $perPage = null)
    {
        $data = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.id_group', '=', 'groups.id')
            ->where('trash', 0);
        // ->orderBy('users.created_at', 'desc');
        $sortBy = 'created_at';
        $sortType = 'desc';
        if (!empty($arrSort) && is_array($arrSort)) {
            if (!empty($arrSort['sort-by']) && !empty($arrSort['sort-type'])) {
                $sortBy = trim($arrSort['sort-by']);
                $sortType = trim($arrSort['sort-type']);
            }
            // dd($sortBy);
        }
        $data = $data->orderBy('users.' . $sortBy, $sortType);
        if (!empty($filters)) {
            $data = $data->where($filters);
        }
        // Lưu ý: get() nên được gọi sau khi tất cả các điều kiện đã được áp dụng.
        if (!empty($keywords)) {
            $data = $data->where('users.name', 'like', '%' . $keywords . '%');
            $data = $data->orWhere('users.email', 'like', '%' . $keywords . '%');
        }
        if (!empty($perPage)) {
            $data = $data->paginate($perPage);
        } else {
            $data = $data->get();
        }

        return $data;
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
