<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DetailPeriksa extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'detail_periksa';

    protected $fillable = [
        'id_periksa','id_obat'
    ];

    public function periksa() {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }
    public function obat() {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
