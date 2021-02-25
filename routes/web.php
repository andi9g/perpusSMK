<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\anggotaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//welcome
Route::get('/welcome', 'welcome@index');
Route::get('/login', 'welcome@login');
Route::patch('/login/proses', 'welcome@proses_login');

Route::middleware(['status','anggota'])->group(function () {
    Route::get('/dashboard', 'welcome@anggota');
    Route::get('/pinjaman', 'welcome@pinjaman');
    Route::get('/kembali', 'welcome@kembali');

});


//profile
Route::middleware(['status'])->group(function () {
    Route::get('/profile','pengaturan@profile');
    Route::put('/profile/ubahpassword','pengaturan@ubahPassword');
    Route::post('/profile/ubahGambar','pengaturan@ubahGambar');
    
    Route::get('/keluar','pengaturan@keluar');
});




Route::middleware(['status','admin'])->group(function () {
//pengaturan
Route::resource('/pengaturan','pengaturan');
Route::post('/pengaturanPerpus','pengaturan@perpus');
Route::post('/pengaturanLogo','pengaturan@logo');


//home
Route::get('/', 'homeController@index');

//anggota
Route::resource('/anggota', 'anggotaController');
Route::get('/anggota/resetPassword/{nis}', 'anggotaController@resetPassword');

//buku
Route::resource('/buku', 'bukuController');


//admin
Route::resource('/admin', 'adminController');
Route::get('/admin/resetPassword/{id_admin}', 'adminController@resetPassword');

//peminjaman
Route::resource('/peminjaman', 'peminjamanController');
Route::get('/peminjamanKhusus', 'peminjamanController@banyakBuku');
Route::post('/peminjamanKhusus/pinjam', 'peminjamanController@pinjamBanyak');

//pengembalian
Route::get('/pengembalian','pengembalianController@index');

// laporan 
Route::post('/cetak/{laporan}', 'pdfController@cekLaporan');
Route::get('/cetak/{laporan}/{ket}', 'pdfController@cetakAnggota');

});
