<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('beranda');
});

//ROUTE ADMIN====================================================================================================
Route::get('/login/admin', [AdminController::class,'login'])->name('login-admin');
Route::post('/login/admin/proses', [AdminController::class,'login_proses'])->name('login-proses-admin');
Route::get('/dashboard/admin', [AdminController::class,'dashboard'])->name('dashboard-admin');
Route::get('/logout/admin', [AdminController::class,'logout'])->name('logout-admin');
//--KELOLA DOKTER
Route::get('/kelola/dokter', [AdminController::class,'kelola_dokter'])->name('kelola-dokter');
Route::get('/create-dokter', [AdminController::class,'create_dokter'])->name('create-dokter');
Route::post('/add-dokter', [AdminController::class,'add_dokter'])->name('add-dokter');
Route::get('/edit-dokter/{id}', [AdminController::class,'edit_dokter'])->name('edit-dokter');
Route::get('/restore-dokter/{id}', [AdminController::class,'restore_dokter'])->name('restore-dokter');
Route::put('/update-dokter/{id}', [AdminController::class,'update_dokter'])->name('update-dokter');
Route::delete('/delete-dokter/{id}', [AdminController::class,'delete_dokter'])->name('delete-dokter');
//--KELOLA PASIEN
Route::get('/kelola/pasien', [AdminController::class,'kelola_pasien'])->name('kelola-pasien');
Route::get('/create-pasien', [AdminController::class,'create_pasien'])->name('create-pasien');
Route::post('/add-pasien', [AdminController::class,'add_pasien'])->name('add-pasien');
Route::get('/edit-pasien/{id}', [AdminController::class,'edit_pasien'])->name('edit-pasien');
Route::get('/restore-pasien/{id}', [AdminController::class,'restore_pasien'])->name('restore-pasien');
Route::put('/update-pasien/{id}', [AdminController::class,'update_pasien'])->name('update-pasien');
Route::delete('/delete-pasien/{id}', [AdminController::class,'delete_pasien'])->name('delete-pasien');
//--KELOLA OBAT
Route::get('/kelola/obat', [AdminController::class,'kelola_obat'])->name('kelola-obat');
Route::get('/create-obat', [AdminController::class,'create_obat'])->name('create-obat');
Route::post('/add-obat', [AdminController::class,'add_obat'])->name('add-obat');
Route::get('/edit-obat/{id}', [AdminController::class,'edit_obat'])->name('edit-obat');
Route::get('/restore-obat/{id}', [AdminController::class,'restore_obat'])->name('restore-obat');
Route::put('/update-obat/{id}', [AdminController::class,'update_obat'])->name('update-obat');
Route::delete('/delete-obat/{id}', [AdminController::class,'delete_obat'])->name('delete-obat');
//--KELOLA POLI
Route::get('/kelola/poli', [AdminController::class,'kelola_poli'])->name('kelola-poli');
Route::get('/create-poli', [AdminController::class,'create_poli'])->name('create-poli');
Route::post('/add-poli', [AdminController::class,'add_poli'])->name('add-poli');
Route::get('/edit-poli/{id}', [AdminController::class,'edit_poli'])->name('edit-poli');
Route::put('/update-poli/{id}', [AdminController::class,'update_poli'])->name('update-poli');
Route::delete('/delete-poli/{id}', [AdminController::class,'delete_poli'])->name('delete-poli');



//ROUTE DOKTER====================================================================================================
Route::get('/login/dokter', [DokterController::class,'login'])->name('login-dokter');
Route::post('/login/dokter/proses', [DokterController::class,'login_proses'])->name('login-proses-dokter');
Route::get('/dashboard/dokter', [DokterController::class,'dashboard'])->name('dashboard-dokter');
Route::get('/logout/dokter', [DokterController::class,'logout'])->name('logout-dokter');
//--PEMERIKSAAN PASIEN
Route::get('/periksa-pasien', [DokterController::class,'periksa_pasien'])->name('periksa-pasien');
Route::get('/periksa/{id}', [DokterController::class,'periksa'])->name('periksa');
Route::post('/add-periksa', [DokterController::class,'add_periksa'])->name('add-periksa');
Route::get('/edit-periksa/{id}', [DokterController::class,'edit_periksa'])->name('edit-periksa');
Route::put('/update-periksa/{id}', [DokterController::class,'update_periksa'])->name('update-periksa');
//--JADWAL PRAKTEK
Route::get('/jadwal-dokter', [DokterController::class,'jadwal_dokter'])->name('jadwal-dokter');
Route::get('/create-jadwal', [DokterController::class,'create_jadwal'])->name('create-jadwal');
Route::get('/edit-jadwal/{id}', [DokterController::class,'edit_jadwal'])->name('edit-jadwal');
Route::put('/update-jadwal/{id}', [DokterController::class,'update_jadwal'])->name('update-jadwal');
Route::post('/add-jadwal', [DokterController::class,'add_jadwal'])->name('add-jadwal');
Route::post('/toggle-jadwal/{id}', [DokterController::class,'toggle'])->name('toggle-jadwal');
//--SETTING PROFILE
Route::get('/setting/dokter', [DokterController::class,'setting_dokter'])->name('setting-dokter');
Route::put('/update/dokter', [DokterController::class,'update'])->name('setup-dokter');
//--RIWAYAT PEMERIKSAAN
Route::get('/riwayat-periksa', [DokterController::class,'riwayat_periksa'])->name('list-riwayat-periksa');
Route::get('/riwayat/pasien-{id}', [DokterController::class,'riwayat'])->name('riwayat-periksa');


//ROUTE PASIEN====================================================================================================
Route::get('/login/pasien', [PasienController::class,'login'])->name('login-pasien');
Route::post('/login/pasien/proses', [PasienController::class,'login_proses'])->name('login-proses-pasien');
Route::get('/register/pasien', [PasienController::class,'register'])->name('register');
Route::post('/register/pasien/proses', [PasienController::class,'register_proses'])->name('register-proses');
Route::get('/dashboard/pasien', [PasienController::class,'dashboard'])->name('dashboard-pasien');
Route::get('/logout/pasien', [PasienController::class,'logout'])->name('logout-pasien');
//--DAFTAR POLI
Route::get('/daftar/poli', [PasienController::class,'daftar_poli'])->name('daftar-poli');
Route::post('/add/daftar-poli', [PasienController::class,'add_daftar_poli'])->name('add-daftar-poli');
//--HASIL PEMERIKSAAN
Route::get('/riwayat-pasien', [PasienController::class,'riwayat_pasien'])->name('riwayat-pasien');
Route::get('/riwayat/{id}', [PasienController::class,'riwayat'])->name('riwayat');



//--Fitur Route
Route::get('/print/{id}', [PrintController::class, 'printPdf'])->name('print');
