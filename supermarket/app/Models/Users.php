<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    public function getAllUsers()
    {
        return DB::select('SELECT * FROM users ORDER BY created_at desc');
    }
    public function postUsers($data)
    {
        return DB::insert('INSERT INTO users (name, email , created_at) VALUES( ?, ?,?)', $data);
    }
}
