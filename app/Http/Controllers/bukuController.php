<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\peminjaman;
use App\Models\jenisBuku;
use Illuminate\Http\Request;

class bukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buku = buku::when($request->keyword, function($query) use ($request){
            $query->where('judul_buku','like',"%{$request->keyword}%")
                ->orWhere('kd_buku','like',"%{$request->keyword}%")
                ->orWhere('pengarang','like',"%{$request->keyword}%")
                ->orWhere('penerbit','like',"%{$request->keyword}%")
                ->orWhere('lokasi_rak','like',"%{$request->keyword}%");
        })
        ->join('jenis_buku','jenis_buku.id','=','tb_buku.jenis_buku')
		->select('tb_buku.*','jenis_buku.jenis_buku')
        ->orderBy('judul_buku')
        ->where('tb_buku.ket','tersedia')
        ->paginate($request->limit ? $request->limit : 10);

        $buku->appends($request->only('keyword','limit'));

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
        $jenis_buku = jenisBuku::get();
        return view('pages.tambahBuku',[
            'jenis_buku' => $jenis_buku
        ]);
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
            $buku->ket = "tersedia";
            $buku->save();

            if($buku){
                return redirect('buku')->with('toast_success','Data berhasil di tambahkan');
            }
        } catch (\Throwable $th) {
            return redirect('buku')->with('toast_error','Terjadi Kesalahan');
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
    public function edit(buku $bk, $id)
    {
        try {
            $jenis_buku = jenisBuku::get();
            $buku = $bk->where('id',$id)->first();
            return view('pages.editBuku',[
                'buku'=>$buku,
                'jenis_buku' => $jenis_buku,
            ]);
            //code...
        } catch (\Throwable $th) {
            return redirect('/buku')->with("toast_error","terjadi kesalahan");
        }
       
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
    public function destroy(buku $bk,$kd)
    {
        try {
            $ambil = $bk->where('id',$kd)->first();
            $cek = peminjaman::where('kd_buku',$ambil->kd_buku)->count();
            if($cek == 0 ){
                $buku = buku::destroy($kd);
            }else {
                $buku = false;
            }
            if($buku){
                return redirect('buku')->with('success','Data berhasil di Hapus');
            }else{
                return redirect('buku')->with('warning','Buku sedang dipinjam');
            }
        } catch (\Throwable $th) {
            return redirect('buku')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!'); 
        }
    }
}
