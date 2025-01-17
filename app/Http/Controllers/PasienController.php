<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Periksa;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource..================================================
     */
    public function login()
    {
        return view('pasien.login');
    }
    public function logout(){
        return redirect()->route('login-pasien')->with('succes','Anda telah keluar, Stay Healthy..');
    }
    public function register()
    {
        return view('pasien.register');
    }
    public function dashboard()
    {
        // Pastikan pasien_id ada di session
        if (!session('pasien_id')) {
            return redirect()->route('login-pasien')->withErrors( 'Session expired. Please log in again.');
        }
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        // Hitung total dokter
        $totalDokter = Dokter::count();
        // Hitung total poli
        $totalPoli = Poli::count();
        return view('pasien.dashboard',compact('pasien','totalDokter','totalPoli'));
    }
    public function daftar_poli()
    {
        // Pastikan pasien_id ada di session
        if (!session('pasien_id')) {
            return redirect()->route('login-pasien')->withErrors( 'Session expired. Please log in again.');
        }
        $jadwal = JadwalPeriksa::with('dokter.ruangPoli')->get();
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        return view('pasien.daftar-poli',compact('pasien','jadwal'));
    }
    public function riwayat_pasien()
    {
        // Pastikan pasien_id ada di session
        if (!session('pasien_id')) {
            return redirect()->route('login-pasien')->withErrors( 'Session expired. Please log in again.');
        }
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        // Cek apakah data DaftarPoli untuk pasien ini kosong
        $dataKosong = DaftarPoli::where('id_pasien', $pasienId)->doesntExist();
        if ($dataKosong) {
            return redirect()->route('dashboard-pasien')->withErrors( 'Anda belum pernah daftar poli.');
        }

        // Jika ada data, ambil data DaftarPoli
        $data = DaftarPoli::with([
            'pasien' => function ($query) use ($pasienId) {
                $query->withTrashed()->where('id', $pasienId);
            },
            'jadwalPeriksa.dokter.ruangPoli',
            'periksa.detailPeriksa',
            ])->where('id_pasien', session('pasien_id'))->get(); // filter

        // Kembalikan view dengan data
        return view('pasien.riwayat-pasien', compact('pasien', 'data'));
    }

    /**
     * Dsiplay the form for the specified resource.============================================
     */
    public function riwayat($id){
        // Pastikan pasien_id ada di session
        if (!session('pasien_id')) {
            return redirect()->route('login-pasien')->withErrors( 'Session expired. Please log in again.');
        }
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);

        $obat = Periksa::with('obat')->find($id);
        $data = DetailPeriksa::with([
            'obat',
            'periksa.daftarPoli.pasien',
            'periksa.daftarPoli.jadwalPeriksa.dokter.ruangPoli',
            ])->where('id_periksa', $id)->firstOrFail();

        return view('pasien.riwayat',compact('pasien','data','obat'));
    }



    /**
     * Show the form for creating a new resource.================================================
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly proses resource in storage.================================================.
     */
    public function login_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'no_ktp'=>'required',
        ]);

        $nama = $request->input('nama');
        $no_ktp = $request->input('no_ktp');

        $np = Pasien::where('nama', $nama)->first();
        $pp = Pasien::where('no_ktp', $no_ktp)->first();
        // Periksa apakah pasien ditemukan dan no_ktp cocok
        if ($np && $pp) {
        // Login berhasil, simpan data pasien di session
            session(['pasien_id' => $np->id]);
            return redirect()->route('dashboard-pasien')->with('success', 'Berhasil Login, Selamat Datang');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-pasien')->with('failed', 'Periksa Username dan Password');
        }
    }
    public function register_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_ktp'=>'required|numeric|min:16|unique:pasien',
            'no_hp'=>'required|numeric|unique:pasien',
        ]);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_ktp'] = $request->no_ktp;
        $data['no_hp'] = $request->no_hp;

        Pasien::create($data);

        $nama = $request->input('nama');
        $no_ktp = $request->input('no_ktp');

        $np = Pasien::where('nama', $nama)->first();
        $pp = Pasien::where('no_ktp', $no_ktp)->first();
        // Periksa apakah pasien ditemukan dan no_ktp cocok
        if ($np && $pp) {
        // Login berhasil, simpan data pasien di session
            session(['pasien_id' => $np->id]);
            return redirect()->route('dashboard-pasien')->with('success', 'Pasien baru berhasil terdaftar masuk');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-pasien')->with('failed', 'Registrasi Gagal, Pasien sudah terdaftar');
        }
    }
    public function add_daftar_poli(Request $request){
        $pasienId = session('pasien_id');
        $request->merge(['id_pasien' => $pasienId]);
        $validator = Validator::make($request -> all(),[
            'id_pasien'=>'required',
            'id_jadwal'=>'required|exists:jadwal_periksa,id',
            'keluhan'=>'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['id_pasien']  = $pasienId;
        $data['id_jadwal']  = $request->id_jadwal;
        $data['keluhan'] = $request->keluhan;

        DaftarPoli::create($data);

        return redirect()->route('riwayat-pasien')->with('success', 'Pendaftaran berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        //
    }

    // additional
    public function getPeriksaData($id)
    {
        $periksa = Periksa::with('detailPeriksa.obat')->findOrFail($id);
        return response()->json($periksa);
    }

}
