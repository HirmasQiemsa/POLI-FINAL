<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use Notifiable,SoftDeletes,HasFactory;
    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama','alamat','no_ktp','no_hp','no_rm',
    ];
    public function daftarPoli() {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

   //noRM pake Observer



}
