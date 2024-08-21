<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected  $table = "users";
    use HasFactory;

    public function getAllUsers()
    {
        return DB::select('SELECT * FROM users ORDER BY created_at desc');
    }
    public function postUsers($data)
    {
        return DB::insert('INSERT INTO users (name, email , created_at) VALUES( ?, ?,?)', $data);
    }
    public function getDetail($id)
    {
        return DB::select('SELECT * FROM users WHERE id =?', [$id]);
    }
    public function updateUser($id, $data)
    {
        $data = array_merge($data, [$id]);
        return DB::update('UPDATE users SET name =?, email =? WHERE id =?', $data);
    }
    public function deleteUser($id)
    {
        return DB::delete('DELETE FROM users WHERE id =?', [$id]);
    }
    public function stastement()
    {
        return DB::statement('SELECT * FROM users');
        // boolean
    }
}
