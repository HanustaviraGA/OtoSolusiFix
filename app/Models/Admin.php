<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\SysRole;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_admin',
        'email',
        'telepon',
        'alamat',
        'password',
        'nama',
        'role_id',
        'forgot_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password'];

    public function sys_role(){
        return $this->belongsTo(SysRole::class, 'role', 'role_id');
    }

}
