<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPeriksa;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\PDF;

class PrintController extends Controller
{


    public function printPdf($id)
    {
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        // Mengambil data berdasarkan id_periksa, dengan eager loading relasi yang diperlukan
        $data = DetailPeriksa::with([
            'obat',
            'periksa.daftarPoli.pasien',
            'periksa.daftarPoli.jadwalPeriksa.dokter.ruangPoli',
        ])->where('id_periksa', $id)->firstOrFail();

        // Generate PDF dengan view yang sesuai dan kirimkan data
        $pdf = PDF::loadView('pasien.riwayat', [
            'data' => $data,
            'pasien' => $pasien // kirim data pasien ke view
            ])
        ->setPaper('A4', 'portrait')  // set paper size and orientation
        ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        // Men-download PDF
        return $pdf->download('riwayat_periksa.pdf');
    }


}
