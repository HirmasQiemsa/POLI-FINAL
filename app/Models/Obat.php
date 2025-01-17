<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Obat extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'obat';
    protected $fillable = [
        'nama_obat','kemasan','harga'
    ];

    public function detailPeriksa() {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
    public function periksa()
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksa', 'id_obat', 'id_periksa');
    }
}
