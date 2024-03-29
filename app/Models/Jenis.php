<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'jenis_name', 'created_at', 'updated_at'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'jenis_id', 'id');
    }
}
