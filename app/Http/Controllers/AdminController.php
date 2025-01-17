<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('admin.login');
    }
    public function logout(){
        return redirect()->route('login-admin')->with('succes','Anda sudah keluar, silahkan login');
    }
    public function kelola_dokter()
    {
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        $data = Dokter::with('ruangPoli')->get();
        $trash = Dokter::with('ruangPoli')->onlyTrashed()->get();
        return view('admin.kelola-dokter',compact('admin','data','trash'));
    }
    public function kelola_pasien()
    {
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        $data = Pasien::get();
        $trash = Pasien::onlyTrashed()->get();
        return view('admin.kelola-pasien',compact('admin','data','trash'));
    }
    public function kelola_obat()
    {
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        $data = Obat::get();
        $trash = Obat::onlyTrashed()->get();
        return view('admin.kelola-obat',compact('admin','data','trash'));
    }
    public function kelola_poli()
    {
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        $data = Poli::get();
        return view('admin.kelola-poli',compact('admin','data'));
    }
    public function dashboard()
    {
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        // Hitung total pasiennya
        $totalPasien = Pasien::count();
        // Hitung total poli
        $totalPoli = Poli::count();
        // Hitung total dokter
        $totalDokter = Dokter::count();
        return view('admin.dashboard', compact('admin','totalPasien','totalPoli','totalDokter'));
    }

    /**
     * Show the form for creating a new resource.---------------------------------------------------------------------
     */
    public function create_poli(){
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view ('admin.create-poli',compact('admin'));
    }
    public function create_obat(){
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view ('admin.create-obat',compact('admin'));
    }
    public function create_dokter(){
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        $poli = Poli::all();
        return view ('admin.create-dokter',compact('admin','poli'));
    }
    public function create_pasien(){
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view ('admin.create-pasien',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.------------------------------------------------------------------------
     */
    public function login_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'password'=>'required',
        ]);

        // Ambil input dari request
        $nama = $request->input('nama');
        $password = $request->input('password');
        // Cari admin berdasarkan nama
        $nd = Admin::where('nama', $nama)->first();
        $pd = Admin::where('password', $password)->first();
        // Periksa apakah admin ditemukan dan password cocok
        if ($nd && $pd) {
        // Login berhasil, simpan data admin di session
            session(['admin_id' => $nd->id]);
            return redirect()->route('dashboard-admin')->with('success', 'Hai, Selamat Datang Kembali');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-admin')->with('failed', 'Periksa Username dan Password');
        }

    }
    public function add_poli(Request $request){
        $validator = Validator::make($request -> all(),[
            'nama_poli'=>'required',
            'keterangan'=>'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama_poli'] = $request->nama_poli;
        $data['keterangan'] = $request->keterangan;

        Poli::create($data);

        return redirect()->route('kelola-poli');
    }
    public function add_obat(Request $request){
        $validator = Validator::make($request -> all(),[
            'nama_obat'=>'required',
            'kemasan'=>'required',
            'harga'=>'required|numeric',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama_obat'] = $request->nama_obat;
        $data['kemasan'] = $request->kemasan;
        $data['harga'] = $request->harga;

        Obat::create($data);

        return redirect()->route('kelola-obat');
    }
    public function add_dokter(Request $request){
        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required|numeric|unique:dokter,no_hp',
            'password'=>'required',
            'id_poli'=>'required|exists:poli,id',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_hp'] = $request->no_hp;
        $data['password'] = $request->password;
        $data['id_poli'] = $request->id_poli;

        Dokter::create($data);

        return redirect()->route('kelola-dokter');
    }
    public function add_pasien(Request $request){
        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_ktp'=>'required|numeric',
            'no_hp'=>'required|numeric',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_ktp'] = $request->no_ktp;
        $data['no_hp'] = $request->no_hp;

        Pasien::create($data);

        return redirect()->route('kelola-pasien');
    }

    /**
     * Display the specified resource.--------------------------------------------------------------------------------
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.------------------------------------------------------------------
     */
    public function edit_poli(Request $request,$id){
        $data = Poli::find($id);
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view('admin.edit-poli',compact('data','admin'));
    }
    public function edit_obat(Request $request,$id){
        $data = Obat::find($id);
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view('admin.edit-obat',compact('data','admin'));
    }
    public function edit_pasien(Request $request,$id){
        $data = Pasien::find($id);
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view('admin.edit-pasien',compact('data','admin'));
    }
    public function edit_dokter(Request $request,$id){
        $data = Dokter::find($id);
        $dokter = Dokter::findOrFail($id);
        $poli = Poli::all();
        $adminId = session('admin_id');
        $admin = Admin::find($adminId);
        return view('admin.edit-dokter',compact('data','admin','poli','dokter'));
    }

    /**
     * Update the specified resource in storage.---------------------------------------------------------------
     */
    public function update_poli(Request $request,$id){
        $validator = Validator::make($request -> all(),[
            'nama_poli'=>'required',
            'keterangan'=>'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama_poli'] = $request->nama_poli;
        $data['keterangan'] = $request->keterangan;

        Poli::whereId($id)->update($data);

        return redirect()->route('kelola-poli');
    }
    public function update_obat(Request $request,$id){
        $validator = Validator::make($request -> all(),[
            'nama_obat'=>'required',
            'kemasan'=>'required',
            'harga'=>'required|numeric',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama_obat'] = $request->nama_obat;
        $data['kemasan'] = $request->kemasan;
        $data['harga'] = $request->harga;

        Obat::whereId($id)->update($data);

        return redirect()->route('kelola-obat');
    }
    public function update_pasien(Request $request,$id){
        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_ktp'=>'required|numeric',
            'no_hp'=>'required|numeric',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_ktp'] = $request->no_ktp;
        $data['no_hp'] = $request->no_hp;

        Pasien::whereId($id)->update($data);

        return redirect()->route('kelola-pasien');
    }
    public function update_dokter(Request $request,$id){
        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required|numeric',
            'password'=>'required',
            'id_poli'=>'required|exists:poli,id',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_hp'] = $request->no_hp;
        $data['password'] = $request->password;
        $data['id_poli'] = $request->id_poli;

        Dokter::whereId($id)->update($data);

        return redirect()->route('kelola-dokter');
    }

    /**
     * Remove the specified resource from storage.--------------------------------------------------------------
     */
    public function delete_poli($id){
        $data = Poli::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('kelola-poli');
    }
    public function delete_obat($id){
        $data = Obat::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('kelola-obat');
    }
    public function delete_pasien($id){
        $data = Pasien::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('kelola-pasien');
    }
    public function delete_dokter($id){
        $data = Dokter::findOrFail($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('kelola-dokter')->with('success','Data Dokter Telah Terhapus.');
    }

    /**
     * Restore the specified resource from storage.--------------------------------------------------------------
     */
    public function restore_dokter($id) {
        $trash = Dokter::withTrashed()->find($id);
        if($trash){
            $trash->restore();
            Log::info("Dokter berhasil dikembalikan: ", ['id' => $id, 'deleted_at' => $trash->deleted_at]);
        }
        return redirect()->route('kelola-dokter')->with('success', 'Dokter Terdaftar Kembali.');
    }
    public function restore_pasien($id) {
        $trash = Pasien::withTrashed()->find($id);
        if($trash){
            $trash->restore();
            Log::info("Pasien berhasil dikembalikan: ", ['id' => $id, 'deleted_at' => $trash->deleted_at]);
        }
        return redirect()->route('kelola-pasien')->with('success', 'Pasien Terdaftar Kembali.');
    }
    public function restore_obat($id) {
        $trash = Obat::withTrashed()->find($id);
        if($trash){
            $trash->restore();
            Log::info("Obat berhasil dikembalikan: ", ['id' => $id, 'deleted_at' => $trash->deleted_at]);
        }
        return redirect()->route('kelola-obat')->with('success', 'Obat Sudah Restock.');
    }
}
