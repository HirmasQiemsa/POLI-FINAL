<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periksa extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'periksa';
    protected $fillable = [
        'id_daftar_poli','tgl_periksa','catatan','biaya_periksa'
    ];
    protected $obat_ids = []; // Properti internal untuk menyimpan ID obat


    public function setObatIds(array $obat_ids)
    {
        $this->obat_ids = $obat_ids;
    }
    public function getObatIds()
    {
        return $this->obat_ids;
    }


    public function daftarPoli() {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }
    public function detailPeriksa() {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
    public function obat() {
        return $this->belongsToMany(Obat::class, 'detail_periksa', 'id_periksa', 'id_obat');
    }

    public function getTotalHargaAttribute() {
        return $this->detailPeriksa->sum('harga');
    }
}
