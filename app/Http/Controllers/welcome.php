<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengaturanLogo;
use App\Models\pengaturanPerpus;
use App\Models\buku;
use App\Models\anggota;
use App\Models\peminjaman;
use App\Models\admin;
use App\Models\perangkat;
use App\Models\daftarPengunjung;
use App\Models\pengembalian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class welcome extends Controller
{
    public function index()
    {
        $perangkat = perangkat::count();
        $buku = buku::orderBy('kd_buku')->get();
        $logo = pengaturanLogo::first();
        $perpus = pengaturanPerpus::first();
        return view('welcome', [
            'logo' => $logo,
            'perpus' => $perpus,
            'buku' => $buku,
            'perangkat' => $perangkat
        ]);
    }

    public function login()
    {
        $logo = pengaturanLogo::first();
        $perpus = pengaturanPerpus::first();
        return view('login', [
            'logo' => $logo,
            'perpus' => $perpus
        ]);
    }

    public function halamanPengunjung()
    {
        try {
            $perangkat = perangkat::count();
        $buku = buku::orderBy('kd_buku')->get();
        $logo = pengaturanLogo::first();
        $perpus = pengaturanPerpus::first();
        $anggota = anggota::join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
        ->select('tb_anggota.nis','tb_anggota.namaAnggota','jurusan.jurusan')
        ->orderBy('tb_anggota.namaAnggota')
        ->get();
        return view('pengunjung',[
            'logo' => $logo,
            'perpus' => $perpus,
            'buku' => $buku,
            'perangkat' => $perangkat,
            'anggota' => $anggota
        ]);
        } catch (\Throwable $th) {
            return redirect('/welcome');
        }
        
    }

    public function tambahPengunjung(Request $request)
    {
        $request->validate([
            'pengunjung' => 'required',
        ]);

        try {
            
            $pengunjung = new daftarPengunjung;
            $pengunjung->nis = $request->pengunjung;
            $pengunjung->save();

            if($pengunjung){
                return redirect('/pengunjung')->with('success','Terimakasih telah berkunjung..');
            }else {
                return redirect('/pengunjung')->with('toast_error','Data pengunjung gagal ditambahkan..');
            }


        } catch (\Throwable $th) {
            return redirect('/pengunjung')->with('toast_error','Terjadi kesalahan');
        }
    }

    public function perangkat()
    {
        try {
            $cekperangkat = perangkat::count();
        if($cekperangkat == 0) {
            $perangkat = $_SERVER['HTTP_USER_AGENT'];
            $ambil1 = explode(')', $perangkat);
            $perangkat = $ambil1[0];

            $tambah = new perangkat;
            $tambah->perangkat = $perangkat;
            $tambah->save();
            if($tambah) {
                return redirect('/pengunjung')->with('success','Perangkat berhasil diterima');
            }
            
        }else {
            return redirect('/welcome');
        }
        } catch (\Throwable $th) {
            return redirect('/welcome');
        }
        
    }

    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $username = $request->username;
            $password = $request->password;
            $sebagai = $request->sebagai;
            
            if($sebagai == "anggota"){
                $anggota = anggota::where('nis',$username)->first();
                if ($anggota) {
                    if(Hash::check($password, $anggota->password)){
                        $request->session()->put('nama_pengguna', $anggota->namaAnggota);
                        $request->session()->put('status', 'anggota');
                        $request->session()->put('nis', $anggota->nis);
                        $request->session()->put('id', $anggota->id);
                        $request->session()->put('login', true);
                        return redirect('/');
                    }else{
                        return redirect('/login')->with('toast_error','Username atau password salah..');
                    }
                }else{
                    return redirect('/login')->with('toast_error','Username atau password salah..');
                }
                
            }else if($sebagai == "admin"){
                $admin = admin::where('username',$username)->first();
                if ($admin) {
                    if(Hash::check($password, $admin->password)){
                        $request->session()->put('nama_pengguna', $admin->nama_admin);
                        $request->session()->put('status', 'admin');
                        $request->session()->put('id', $admin->id);
                        $request->session()->put('login', true);
                        return redirect('/');
                    }else{
                        return redirect('/login')->with('toast_error','Username atau password salah..');
                    }
                }else{
                    return redirect('/login')->with('toast_error','Username atau password salah..');
                }

            }else {
                return redirect('/login')->with('toast_error','Terjadi Kesalahan!.');
            }


        } catch (\Throwable $th) {
            return redirect('/login')->with('toast_error','Terjadi Kesalahan!.');
        }
        
    }

    public function anggota(Request $request)
    {
        $pengguna = $request->session()->get('nis');
        $pinjaman = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
        ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
        ->where('status','pinjam')
        ->where('tb_peminjaman.nis',$pengguna)
        ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
        ->count();
        $kembali = pengembalian::join('tb_anggota','tb_anggota.nis','=','tb_pengembalian.nis')
        ->join('tb_buku','tb_buku.kd_buku','=','tb_pengembalian.kd_buku')
        ->where('status','kembali')
        ->where('tb_pengembalian.nis',$pengguna)
        ->select('tb_pengembalian.nis','tb_pengembalian.jumlah_pinjam','tb_pengembalian.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
        ->count();
        return view('pages/dashboard',[
            'jumlah_peminjaman' => $pinjaman,
            'jumlah_pengembalian' => $kembali
        ]);
    }

    public function pinjaman(Request $request)
    {
        $pengguna = $request->session()->get('nis');
        $pinjaman = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
        ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
        ->where('status','pinjam')
        ->where('tb_peminjaman.nis',$pengguna)
        ->orderBy('tb_peminjaman.ket','desc')
        ->orderBy('tb_peminjaman.created_at','asc')
        ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
        ->get();

        return view('pages/pinjaman',[
            'buku' => $pinjaman
        ]);
    }
    public function kembali(Request $request)
    {
        $pengguna = $request->session()->get('nis');
        $pinjaman = pengembalian::join('tb_anggota','tb_anggota.nis','=','tb_pengembalian.nis')
        ->join('tb_buku','tb_buku.kd_buku','=','tb_pengembalian.kd_buku')
        ->where('status','kembali')
        ->where('tb_pengembalian.nis',$pengguna)
        ->select('tb_pengembalian.nis','tb_pengembalian.jumlah_pinjam','tb_pengembalian.kd_buku','tb_buku.judul_buku','tb_pengembalian.created_at','tb_pengembalian.updated_at','tb_pengembalian.ket','tb_anggota.namaAnggota')
        ->get();

        return view('pages/pinjamanKembali',[
            'buku' => $pinjaman
        ]);
    }

}
