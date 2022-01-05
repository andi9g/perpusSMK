<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\peminjaman;
use App\Models\logpeminjaman;
use App\Models\pengembalian;
use App\Models\anggota;
use App\Models\buku;

class homeController extends Controller
{
    public function index(){
        //chart
        $jumlah_pinjam_bulan = [];
        $jumlah_kembali_bulan = [];
        $bulan = [];
        $nama_bulan = ['JAN','FEB','MAR','APR','MAI','JUN','JUL','AUG','SEP','OKT','NOV','DES'];
        $bln = 1;
        $tahun = date('Y');

        for($bln;$bln<=12;$bln++){
            if($bln<=9){
                $j_pinjam = logpeminjaman::orderBy('id')
                ->where('created_at','like',"%{$tahun}-0{$bln}%")
                ->count();
                $j_kembali = pengembalian::orderBy('id')
                ->where('created_at','like',"%{$tahun}-0{$bln}%")
                ->where('status','=','kembali')
                ->count();
                $jumlah_kembali_bulan[] = $j_kembali;
                $jumlah_pinjam_bulan[] = $j_pinjam;
                $bulan[] = $nama_bulan[$bln-1];
                
            }else {
                $j_pinjam = logpeminjaman::orderBy('id')
                ->where('created_at','like',"%{$tahun}-{$bln}%")
                ->count();
                $j_kembali = pengembalian::orderBy('id')
                ->where('created_at','like',"%{$tahun}-{$bln}%")
                ->where('status','=','kembali')
                ->count();
                
                $jumlah_kembali_bulan[] = $j_kembali;
                $jumlah_pinjam_bulan[] = $j_pinjam;
                $bulan[] = $nama_bulan[$bln-1];
            }
        }
        //buku
        $jumlah_buku = buku::where('ket','tersedia')->count();

        //jumlah anggota
        $jumlah_anggota = anggota::count();

        //total pinjam hari ini
        $sekarang = date('Y-m-d');
        $total_pinjam_hari_ini = logpeminjaman::where('created_at', 'like',"%{$sekarang}%")
        ->count();
        $total_kembali_hari_ini = pengembalian::where('updated_at', 'like',"%{$sekarang}%")
        ->where('status','=','kembali')
        ->count();

        $jumlah = max($jumlah_pinjam_bulan);
        
        return view('pages.home', [
            'jumlah_pinjam_bulan' => json_encode($jumlah_pinjam_bulan),
            'jumlah_kembali_bulan' => json_encode($jumlah_kembali_bulan),
            'nama_bulan' => json_encode($bulan),
            'jumlah_buku' => $jumlah_buku,
            'jumlah_anggota' => $jumlah_anggota,
            'total_pinjam_hari_ini' => $total_pinjam_hari_ini,
            'total_kembali_hari_ini' => $total_kembali_hari_ini,
            'jumlah' => $jumlah
        ]);
    }
}
