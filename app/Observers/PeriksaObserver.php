<?php
namespace App\Observers;

use App\Models\Periksa;
use App\Models\DetailPeriksa;

class PeriksaObserver
{
    public function created(Periksa $periksa)
    {
        // Simpan detail periksa untuk masing-masing obat
        foreach ($periksa->getObatIds() as $obat_id) {
            $detailPeriksa = new DetailPeriksa;
            $detailPeriksa->id_periksa = $periksa->id;
            $detailPeriksa->id_obat = $obat_id;
            $detailPeriksa->save();
        }
    }

    public function updated(Periksa $periksa)
    {
        // Hapus detail periksa lama
        $periksa->detailPeriksa()->delete();

        // Simpan detail periksa baru
        foreach ($periksa->getObatIds() as $obat_id) {
            $detailPeriksa = new DetailPeriksa;
            $detailPeriksa->id_periksa = $periksa->id;
            $detailPeriksa->id_obat = $obat_id;
            $detailPeriksa->save();
        }
    }
}
