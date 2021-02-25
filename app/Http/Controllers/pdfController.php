<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\buku;
use App\Models\admin;
use App\Models\peminjaman;
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
                $query = buku::where("kd_buku","like","%{$ket}%")
                ->orWhere("judul_buku","like","%{$ket}%")
                ->orWhere("pengarang","like","%{$ket}%")
                ->orWhere("penerbit","like","%{$ket}%")
                ->orWhere("jenis_buku","like","%{$ket}%")
                ->orWhere("tahun","like","%{$ket}%")
                ->orWhere("lokasi_rak","like","%{$ket}%")->get();
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
                ->where("tb_peminjaman.ket","=","-")
                ->where('tb_peminjaman.status','=','pinjam')
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')->get();

                $pdf = PDF::loadView('laporan.laporanPeminjaman', [
                    'tampil' => $query,
                    'ket' => $ket,
                    'laporan' => $laporan 
                    ]);
            }else if($ket=="peminjamanKhusus"){
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where("tb_peminjaman.ket","!=","-")
                ->where('tb_peminjaman.status','=','pinjam')
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')->get();

                $pdf = PDF::loadView('laporan.laporanPeminjamanKhusus', [
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
                ->where("tb_peminjaman.ket","=","-")
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
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where('tb_peminjaman.status','=','kembali')
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_peminjaman.updated_at','tb_anggota.namaAnggota')->get();
            }else {
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where("tb_peminjaman.nis","like","%{$ket}%")
                ->orWhere("tb_peminjaman.kd_buku","like","%{$ket}%")
                ->orWhere("tb_buku.judul_buku","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("tb_peminjaman.created_at","like","%{$ket}%")
                ->orWhere("tb_peminjaman.updated_at","like","%{$ket}%")
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.updated_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
                ->where('tb_peminjaman.status','=','kembali')
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanPengembalian', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }else if($laporan=="peminjam"){
            if($ket=="keseluruhan"){
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_peminjaman.updated_at','tb_anggota.namaAnggota')->get();
            }else {
                $query = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                ->where("tb_peminjaman.nis","like","%{$ket}%")
                ->orWhere("tb_peminjaman.kd_buku","like","%{$ket}%")
                ->orWhere("tb_buku.judul_buku","like","%{$ket}%")
                ->orWhere("tb_anggota.namaAnggota","like","%{$ket}%")
                ->orWhere("tb_peminjaman.created_at","like","%{$ket}%")
                ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.updated_at','tb_peminjaman.ket','tb_anggota.namaAnggota')
                ->get();
            }

            $pdf = PDF::loadView('laporan.laporanPeminjam', [
                'tampil' => $query,
                'ket' => $ket,
                'laporan' => $laporan 
                ]);
        }
        
  
 
        return $pdf->stream();
    }
}
