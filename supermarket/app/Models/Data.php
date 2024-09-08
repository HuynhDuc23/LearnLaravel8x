<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'datas';

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
