<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\anggota;
use App\Models\buku;
use Illuminate\Http\Request;

class pengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = peminjaman::join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
        ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
        ->where('status','pinjam')
        ->orderBy('ket','desc')
        ->orderBy('created_at','asc')
        ->select('tb_peminjaman.nis','tb_peminjaman.id','tb_peminjaman.jumlah_pinjam','tb_peminjaman.kd_buku','tb_buku.judul_buku','tb_peminjaman.created_at','tb_peminjaman.ket','tb_anggota.namaAnggota')->get();

        return view('pages.pengembalian', [
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(peminjaman $peminjaman)
    {
        //
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
    public function update(Request $request, peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(peminjaman $peminjaman)
    {
        
        
        
    }
}
