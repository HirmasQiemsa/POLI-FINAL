<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPeriksa extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'jadwal_periksa';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id_dokter','hari','jam_mulai','jam_selesai'
    ];

    public function getIsActiveAttribute(){
        return is_null($this->deleted_at);
    }

    public function dokter(){
        return $this->belongsTo(Dokter::class,'id_dokter');
    }
    public function daftarPoli() {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal','id');
    }
}
