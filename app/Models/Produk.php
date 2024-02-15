<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'merek', 'jenis_id', 'harga', 'jumlah_stok', 'keterangan', 'created_at', 'updated_at'
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id', 'id');
    }
}
