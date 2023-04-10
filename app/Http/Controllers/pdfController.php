<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\admin;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\daftarPengunjung;
use App\Models\logpeminjaman;
use Illuminate\Http\Request;
use PDF;

class pdfController extends Controller
{
    public function cekLaporan(Request $request, $laporan)
    {

        if ($laporan=="anggota") {
            
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }else if($laporan=='buku'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }else if($laporan=='admin'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }else if($laporan=='peminjaman'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }else if($request->pilihCetak=="peminjamanKhusus"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }
        }elseif($laporan=='pengembalian'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }elseif($laporan=='peminjam'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }elseif($laporan=='daftarPengunjung'){
            if($request->pilihCetak=="keseluruhan"){
                return redirect("/cetak"."/".$laporan."/".$request->pilihCetak);
            }else if($request->pilihCetak=="berdasarkan"){
                $pencarian = $request->cariCetak;
                return redirect("/cetak"."/".$laporan."/".$pencarian);
            }
        }
    
    }
    public function cetakAnggota($laporan,$ket)
    {
        if($laporan=="anggota"){
            if($ket=="keseluruhan"){
                $query = anggota::join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
                        ->select('tb_anggota.nis','tb_anggota.namaAnggota','tb_anggota.noHp','tb_anggota.password','jurusan.jurusan','tb_anggota.created_at')
                        ->orderBy('tb_anggota.nis')
                        ->get();
            }else{
                $query = anggota::join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
                ->where("tb_anggota.nis","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("jurusan.jurusan","like","%{$ket}%")
                ->orWhere("tb_anggota.created_at","like","%{$ket}%")
                ->select('tb_anggota.nis','tb_anggota.namaAnggota','tb_anggota.noHp','tb_anggota.created_at','jurusan.jurusan')
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanAnggota', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);


        }else if($laporan=="buku"){
            if($ket=="keseluruhan"){
                $query = buku::orderBy('id')->get();
            }else{
                $query = buku::
					where("judul_buku","like","{$ket}%")
					->orWhere("pengarang","like","{$ket}%")
					->orWhere("jenis_buku","like","{$ket}%")
					->orWhere("lokasi_rak", "like", "{$ket}%")
				->get();
            }

            $pdf = PDF::loadView('laporan.laporanBuku', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }else if($laporan=='admin'){
            if($ket=="keseluruhan"){
                $query = admin::orderBy('id')->get();
            }else{
                $query = admin::where("nama_admin","like","%{$ket}%")
                ->orWhere("created_at","like","%{$ket}%")
                ->orWhere("username","like","%{$ket}%")->get();
            }

            $pdf = PDF::loadView('laporan.laporanAdmin', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }else if($laporan=='peminjaman'){
            if($ket=="keseluruhan"){
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where('tb_peminjaman.status','=','pinjam')
					->orderBy('tb_peminjaman.created_at', 'ASC')
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')->get();

                $pdf = PDF::loadView('laporan.laporanPeminjaman', [
                    'tampil' => $query,
                    'ket' => $ket,
                    'laporan' => $laporan 
                    ]);
            }else{
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where("tb_peminjaman.nis","like","%{$ket}%")
                ->orWhere("tb_peminjaman.kd_buku","like","%{$ket}%")
                ->orWhere("tb_buku.judul_buku","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("tb_peminjaman.created_at","like","%{$ket}%")
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
                ->where('tb_peminjaman.status','=','pinjam')
                ->get();


                $pdf = PDF::loadView('laporan.laporanPeminjaman', [
                    'tampil' => $query,
                    'ket' => $ket,
                    'laporan' => $laporan 
                    ]);
            }
        }else if($laporan=="pengembalian"){
            if($ket=="keseluruhan"){
                $query = pengembalian::join('tb_anggota','tb_anggota.nis','=','tb_pengembalian.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_pengembalian.kd_buku')
                ->where('tb_pengembalian.status','=','kembali')
                ->select('tb_pengembalian.nis','tb_pengembalian.jumlah_pinjam','tb_pengembalian.kd_buku','tb_buku.judul_buku','tb_pengembalian.created_at','tb_pengembalian.status','tb_pengembalian.ket','tb_pengembalian.updated_at','tb_anggota.namaAnggota')->get();
            }else {
                $query = pengembalian::join('tb_anggota','tb_anggota.nis','=','tb_pengembalian.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_pengembalian.kd_buku')
                ->where("tb_pengembalian.nis","like","%{$ket}%")
                ->orWhere("tb_pengembalian.kd_buku","like","%{$ket}%")
                ->orWhere("tb_buku.judul_buku","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("tb_pengembalian.created_at","like","%{$ket}%")
                ->select('tb_pengembalian.nis','tb_pengembalian.jumlah_pinjam','tb_pengembalian.kd_buku','tb_buku.judul_buku','tb_pengembalian.created_at','tb_pengembalian.status','tb_pengembalian.updated_at','tb_pengembalian.ket','tb_anggota.namaAnggota')
                ->where('tb_pengembalian.status','=','kembali')
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanPengembalian', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }else if($laporan=="peminjam"){
            if($ket=="keseluruhan"){
                $query = logpeminjaman::leftJoin('tb_anggota','tb_anggota.nis','=','log_peminjaman.nis')
                ->leftJoin('tb_buku','tb_buku.kd_buku','=','log_peminjaman.kd_buku')
                ->select('log_peminjaman.nis', 'log_peminjaman.status','log_peminjaman.jumlah_pinjam','log_peminjaman.kd_buku','tb_buku.judul_buku','log_peminjaman.created_at','log_peminjaman.ket','log_peminjaman.updated_at','tb_anggota.namaAnggota')->get();
            }else {
                $query = logpeminjaman::leftJoin('tb_anggota','tb_anggota.nis','=','log_peminjaman.nis')
                ->leftJoin('tb_buku','tb_buku.kd_buku','=','log_peminjaman.kd_buku')
                ->where("log_peminjaman.nis","like","%{$ket}%")
                ->orWhere("log_peminjaman.kd_buku","like","%{$ket}%")
                ->orWhere("tb_buku.judul_buku","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("log_peminjaman.created_at","like","%{$ket}%")
					->orderBy('log_peminjaman.created_at', 'ASC')
                ->select('log_peminjaman.nis','log_peminjaman.status','log_peminjaman.jumlah_pinjam','log_peminjaman.kd_buku','tb_buku.judul_buku','log_peminjaman.created_at','log_peminjaman.updated_at','log_peminjaman.ket','tb_anggota.namaAnggota')
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanPeminjam', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }else if ($laporan=="daftarPengunjung"){
            if($ket=="keseluruhan"){
                $query = anggota::join('jurusan','jurusan.id','=','tb_anggota.id_jurusan')
                ->join('daftar_pengunjung','daftar_pengunjung.nis','=','tb_anggota.nis')
                ->select('daftar_pengunjung.id','daftar_pengunjung.nis','tb_anggota.namaAnggota','jurusan.jurusan','daftar_pengunjung.created_at')
                ->get();
            }else {
                $query = anggota::join('jurusan','jurusan.id','=','tb_anggota.id_jurusan')
                ->join('daftar_pengunjung','daftar_pengunjung.nis','=','tb_anggota.nis')
                ->select('daftar_pengunjung.id','daftar_pengunjung.nis','tb_anggota.namaAnggota','jurusan.jurusan','daftar_pengunjung.created_at')
                ->where("daftar_pengunjung.created_at","like","{$ket}%")
					->orderBy("daftar_pengunjung.created_at", "asc")
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanPengunjung', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
            ]);

        }
        
  
 
        return $pdf->stream();
    }
}
