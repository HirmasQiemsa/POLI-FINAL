<?php

namespace App\Observers;

use App\Models\Pasien;

class PasienObserver
{
    /**
     * Handle the Pasien "created" event.
     */
    public function creating(Pasien $pasien): void
    {
        if (is_null($pasien->no_rm)) {
            $latestId = Pasien::max('id') + 1;
            $pasien->no_rm = now()->format('Ym') . str_pad($latestId, 3, '0', STR_PAD_LEFT);
            }
    }

    /**
     * Handle the Pasien "updated" event.
     */
    public function updating(Pasien $pasien) {
        // Pastikan no_rm tidak berubah saat updating
        if ($pasien->isDirty('no_rm')) {
        $pasien->no_rm = $pasien->getOriginal('no_rm'); }
    }

    /**
     * Handle the Pasien "deleted" event.
     */
    public function deleted(Pasien $pasien): void
    {
        //
    }

    /**
     * Handle the Pasien "restored" event.
     */
    public function restored(Pasien $pasien): void
    {
        //
    }

    /**
     * Handle the Pasien "force deleted" event.
     */
    public function forceDeleted(Pasien $pasien): void
    {
        //
    }
}
