<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarPoli extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'daftar_poli';

    protected $fillable = [
        'id_jadwal','id_pasien','keluhan','no_antrian',
    ];

    public function pasien() {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
    public function jadwalPeriksa() {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal','id');
    }
    public function periksa() {
        return $this->hasMany(Periksa::class, 'id_daftar_poli')->orderBy('created_at', 'asc'); // Sesuaikan field sorting;
    }
}
