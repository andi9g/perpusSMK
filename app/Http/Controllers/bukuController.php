<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = buku::orderBy('kd_buku')->get();
        return view('pages.buku',[
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tambahBuku');
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
            'kd_buku' => 'required|max:8',
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'jenis_buku' => 'required',
            'lokasi_rak' => 'required',
            'stok' => 'required',
        ]);

        try {
            
            
            $buku = new buku;
            $buku->kd_buku = $request->kd_buku;
            $buku->judul_buku = $request->judul_buku;
            $buku->pengarang = $request->pengarang;
            $buku->penerbit = $request->penerbit;
            $buku->tahun = $request->tahun;
            $buku->jenis_buku = $request->jenis_buku;
            $buku->lokasi_rak = $request->lokasi_rak;
            $buku->stok = $request->stok;
            $buku->save();

            if($buku){
                return redirect('buku')->with('toast_success','Data berhasil di tambahkan');
            }
        } catch (\Throwable $e) {
            return redirect('buku/create')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!');  
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(buku $buku)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(buku $buku)
    {
        return view('pages.editBuku',compact('buku'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buku $buku)
    {
        
        $request->validate([
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'jenis_buku' => 'required',
            'lokasi_rak' => 'required',
            'stok' => 'required',
        ]);

        try {
            
            
            $update = buku::where('id',$buku->id)->update([
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'jenis_buku' => $request->jenis_buku,
            'lokasi_rak' => $request->lokasi_rak,
            'stok' => $request->stok,
            ]);

            if($buku){
                return redirect('buku')->with('toast_success','Data berhasil di tambahkan');
            }
        } catch (\Throwable $e) {
            return redirect('buku/edit')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!');  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(buku $buku)
    {
        try {
            $buku = buku::destroy($buku->id);
            if($buku){
                return redirect('buku')->with('toast_warning','Data berhasil di Hapus');
            }
        } catch (\Throwable $th) {
            return redirect('buku/edit')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!'); 
        }
    }
}
