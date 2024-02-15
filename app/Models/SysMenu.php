<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SysRole;

class SysMenu extends Model
{
    use HasFactory;
    protected $table = 'conf_menu';
    protected $primaryKey = 'menu_id';
    protected $keyType = 'string';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(SysRole::class, 'conf_role_menu', 'role_menu_menu_id', 'role_menu_role_id');
    }
}
