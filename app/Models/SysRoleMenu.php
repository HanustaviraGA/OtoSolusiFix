<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SysRoleMenu extends Model
{
    use HasFactory;
    protected $table = 'conf_role_menu';
    protected $primaryKey = 'role_menu_id';
    protected $keyType = 'string';
    protected $fillable = [
        'role_menu_id',
        'role_menu_menu_id',
        'role_menu_role_id',
    ];

    public function select_menu($id){
        $query = "
        SELECT
            conf_menu.menu_parent,
            conf_menu.menu_id,
            conf_menu.menu_judul,
            conf_menu.menu_icon,
            (
                SELECT sys_role_menu.role_menu_id
                FROM sys_role_menu
                WHERE sys_role_menu.role_menu_menu_id = conf_menu.menu_id
                AND sys_role_menu.role_menu_role_id = '" . $id . "'
                GROUP BY conf_menu.menu_kode
            ) as menu_selected,
            (
                SELECT COUNT(child.menu_parent)
                FROM view_sys_role_menu child
                WHERE child.menu_parent = conf_menu.menu_id
                AND child.role_menu_role_id = '" . $id . "'
            ) as child_total
        FROM conf_menu
        WHERE conf_menu.menu_aktif = '1'
            AND conf_menu.menu_level <= 4
        ORDER BY conf_menu.menu_order ASC;
        ";

        return DB::select($query);
    }
}
