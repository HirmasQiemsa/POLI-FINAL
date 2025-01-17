<?php

namespace App\Observers;

use App\Models\DaftarPoli;

class DaftarPoliObserver
{
    /**
     * Handle the DaftarPoli "created" event.
     */
    public function creating(DaftarPoli $daftarPoli): void
    {
        if (is_null($daftarPoli->no_antrian)) {
            $latestId = DaftarPoli::max('id') + 1;
            $daftarPoli->no_antrian = $latestId;
            }
    }

    /**
     * Handle the DaftarPoli "updated" event.
     */
    public function updating(DaftarPoli $daftarPoli) {
        // Pastikan no_rm tidak berubah saat updating
        if ($daftarPoli->isDirty('no_antrian')) {
        $daftarPoli->no_antrian = $daftarPoli->getOriginal('no_antrian'); }
    }

    /**
     * Handle the DaftarPoli "deleted" event.
     */
    public function deleted(DaftarPoli $daftarPoli): void
    {
        //
    }

    /**
     * Handle the DaftarPoli "restored" event.
     */
    public function restored(DaftarPoli $daftarPoli): void
    {
        //
    }

    /**
     * Handle the DaftarPoli "force deleted" event.
     */
    public function forceDeleted(DaftarPoli $daftarPoli): void
    {
        //
    }
}
