<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\buku;
use App\Models\anggota;
use App\Models\jurusan;
use Illuminate\Http\Request;

class peminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $anggota = anggota::join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
        ->select('tb_anggota.nis','tb_anggota.namaAnggota','jurusan.jurusan')
        ->orderBy('tb_anggota.namaAnggota')
        ->get();

        $buku  = buku::select('tb_buku.id','kd_buku','judul_buku','jenis_buku.jenis_buku')
        ->join('jenis_buku','jenis_buku.id','=','tb_buku.jenis_buku')
        ->where('tb_buku.ket',"tersedia")
        ->get();

        $peminjaman = peminjaman::when($request->keyword, function($query) use ($request){
            $query->where('tb_peminjaman.nis','like',"%{$request->keyword}%")
                ->orWhere('tb_peminjaman.kd_buku','like',"%{$request->keyword}%")
                ->orWhere('tb_anggota.namaAnggota','like',"%{$request->keyword}%")
                ->orWhere('tb_peminjaman.created_at','like',"%{$request->keyword}%")
                ->orWhere('tb_buku.judul_buku','like',"%{$request->keyword}%");
        })->leftJoin('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
        ->leftJoin('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
        ->where('tb_peminjaman.status','pinjam')
        ->select('tb_peminjaman.nis','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.ket','tb_peminjaman.created_at','tb_peminjaman.status','tb_anggota.namaAnggota')
        ->orderBy('tb_peminjaman.id','desc')
        ->paginate($request->limit ? $request->limit : 10);

        $peminjaman->appends($request->only('keyword','limit'));


        

        return view('pages.peminjaman', [
            'anggota' => $anggota,
            'buku' => $buku,
            'peminjaman' => $peminjaman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ((!empty($request->id_anggota)) && (!empty($request->id_buku))) {
            try {
                $nis = $request->id_anggota;
                $kd_buku = $request->id_buku;
                $jumlah_pinjam = 1;
                $ket = "-";
                $status = "pinjam";

                $buku = buku::where('kd_buku',$kd_buku)->first();
                $total = $buku->stok - $jumlah_pinjam;

                $peminjamanCek = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                    ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                    ->where('tb_peminjaman.status','=','pinjam')
                    ->where('tb_peminjaman.nis','=', $nis)
                    ->where('tb_peminjaman.kd_buku','=', $kd_buku)
                    ->count();

                    $peminjaman = anggota::where('nis',$nis)->first();
                    $peminjamanBuku = buku::where('kd_buku',$kd_buku)->first();
                if($total>=2 && $buku->stok>=2){
                    
                    if($peminjamanCek==0){
                        $tambah = new peminjaman;
                        $tambah->nis = $nis;
                        $tambah->kd_buku = $kd_buku;
                        $tambah->jumlah_pinjam = $jumlah_pinjam;
                        $tambah->ket = $ket;
                        $tambah->status = $status;
                        $tambah->save();
    
                        if($tambah){
                        
                            return redirect()->route('peminjaman.index')->with('success',$peminjaman->namaAnggota.' Berhasil Meminjam Buku ');
                        }

                    }else {
                        return redirect()->route('peminjaman.index')->with('warning',$peminjaman->namaAnggota.' sudah pernah meminjam buku '.$peminjamanBuku->judul_buku);
                    }
                }else {
                    return redirect()->route('peminjaman.index')->with('warning','Stok buku minimal tersisa 2. Sisa stok saat ini ('.$buku->stok.' Buku)');
                }

            } catch (\Throwable $th) {
                return redirect()->route('peminjaman.index')->with('warning','terjadi kesalahan...');
            }
        }else {
            return redirect()->route('peminjaman.index')->with('warning','terjadi kesalahan...');
        }


       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(peminjaman $peminjaman)
    {
        
    }

    public function banyakBuku()
    {
        $anggota = anggota::join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
        ->select('tb_anggota.nis','tb_anggota.namaAnggota','jurusan.jurusan')
        ->orderBy('tb_anggota.namaAnggota')
        ->get();

        $buku  = buku::select('id','kd_buku','judul_buku')->get();

        return view('pages.pinjamSeluruh', [
            'anggota' => $anggota,
            'buku' => $buku,
        ]);
    }

    public function pinjamBanyak(Request $request)
    {
        if ((!empty($request->id_anggota)) && (!empty($request->id_buku))) {
            try {
                $nis = $request->id_anggota;
                $kd_buku = $request->id_buku;
                $jumlah_pinjam = $request->jumlah_pinjam;
                $ket = $request->ket;
                $status = "pinjam";

                $buku = buku::where('kd_buku',$kd_buku)->first();
                $total = $buku->stok - $jumlah_pinjam;

                
                if($total>=2 && $buku->stok>=2){
                    
                    $tambah = new peminjaman;
                    $tambah->nis = $nis;
                    $tambah->kd_buku = $kd_buku;
                    $tambah->jumlah_pinjam = $jumlah_pinjam;
                    $tambah->ket = $ket;
                    $tambah->status = $status;
                    $tambah->save();

                    if($tambah){
                        return redirect()->route('peminjaman.index')->with('success','Buku Berhasil Dipinjam');
                    }

                   
                }else {
                    return redirect()->route('peminjaman.index')->with('warning','Stok buku minimal tersisa 2. Sisa stok saat ini ('.$buku->stok.' Buku)');
                }

            } catch (\Throwable $th) {
                return redirect()->route('peminjaman.index')->with('warning','terjadi kesalahan...');
            }
        }else {
            return redirect()->route('peminjaman.index')->with('warning','terjadi kesalahan...');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peminjaman $kembali, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(peminjaman $kembali,$id)
    {
        try {
            $hapus = $kembali->destroy($id);

            if($hapus){
                return redirect('/pengembalian')->with('success','Pengembalian Berhasil');
            }else{
                return redirect('/pengembalian')->with('toast_error','Pengembalian Gagal, Terjadi kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect('/pengembalian')->with('warning','Terjadi kesalahan');
        }
    }
}
