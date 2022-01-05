<?php

namespace App\Http\Controllers;

use App\Models\daftarPengunjung;
use App\Models\anggota;
use App\Models\jurusan;
use App\Models\perangkat;
use Illuminate\Http\Request;

class daftarPengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perangkat = perangkat::count();
        $daftar_pengunjung = anggota::when($request->keyword, function($query) use ($request){
            $query->where('daftar_pengunjung.nis','like',"%{$request->keyword}%")
                ->orWhere('tb_anggota.namaAnggota','like',"%{$request->keyword}%")
                ->orWhere('jurusan.jurusan','like',"%{$request->keyword}%");
        })->join('jurusan','jurusan.id','=','tb_anggota.id_jurusan')
        ->join('daftar_pengunjung','daftar_pengunjung.nis','=','tb_anggota.nis')
        ->select('daftar_pengunjung.id','daftar_pengunjung.nis','tb_anggota.namaAnggota','jurusan.jurusan','daftar_pengunjung.created_at')
        ->orderBy('daftar_pengunjung.id','DESC')
        ->paginate($request->limit ? $request->limit : 10);

        $daftar_pengunjung->appends($request->only('keyword','limit')); 
        
        return view('pages.daftarPengunjung',[
            'daftar_pengunjung' => $daftar_pengunjung,
            'perangkat' => $perangkat
        ]);
    }

    public function resetPerangkat(Request $request)
    {
       try {
           $delete = perangkat::truncate();
           if($delete) {
               return redirect('/daftarPengunjung')->with('success','Reset Perangkat Akses daftar pengunjung berhasil');
           }
       } catch (\Throwable $th) {
        return redirect('/daftarPengunjung')->with('toast_success','Terjadi kesalahan!');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'pengunjung' => 'required',
        ]);

        try {
            
            $pengunjung = new daftarPengunjung;
            $pengunjung->nis = $request->pengunjung;
            $pengunjung->save();

            if($pengunjung){
                return redirect('daftarPengunjung')->with('toast_success','Data pengunjung berhasil ditambahkan..');
            }else {
                return redirect('daftarPengunjung')->with('toast_error','Data pengunjung gagal ditambahkan..');
            }


        } catch (\Throwable $th) {
            return redirect('daftarPengunjung')->with('toast_error','Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\daftarPengunjung  $daftarPengunjung
     * @return \Illuminate\Http\Response
     */
    public function show(daftarPengunjung $daftarPengunjung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\daftarPengunjung  $daftarPengunjung
     * @return \Illuminate\Http\Response
     */
    public function edit(daftarPengunjung $daftarPengunjung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\daftarPengunjung  $daftarPengunjung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, daftarPengunjung $daftarPengunjung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\daftarPengunjung  $daftarPengunjung
     * @return \Illuminate\Http\Response
     */
    public function destroy(daftarPengunjung $data, $id)
    {
        
        $hapus = $data->destroy($id);

        if($hapus){
            return redirect('daftarPengunjung')->with('toast_success','Data pengunjung berhasil dihapus..');
        }else {
            return redirect('daftarPengunjung')->with('toast_error','Data pengunjung gagal dihapus..');
        }
    }
}
