<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use App\Models\peminjaman;
use App\Models\jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class anggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $anggota = anggota::when($request->keyword, function($query) use ($request){
            $query->where('tb_anggota.nis','like',"%{$request->keyword}%")
                ->orWhere('tb_anggota.namaAnggota','like',"%{$request->keyword}%")
                ->orWhere('jurusan.jurusan','like',"%{$request->keyword}%");
        })->join('jurusan','tb_anggota.id_jurusan','=','jurusan.id')
        ->select('tb_anggota.nis','tb_anggota.namaAnggota','tb_anggota.noHp','tb_anggota.password','jurusan.jurusan')
        ->orderBy('tb_anggota.nis')
        ->paginate($request->limit ? $request->limit : 10);
        
        $anggota->appends($request->only('keyword','limit'));
        return view('pages.anggota',[
            'anggota' => $anggota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = jurusan::get();
        return view('pages.tambahAnggota',[
            'jurusan' => $jurusan
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
            'nisAnggota' => 'required|max:8',
            'namaAnggota' => 'required|',
            'jurusan' => 'required',
            'noHp' => 'required|max:14',
        ]);

        
            $password_hash = Hash::make('perpus12345');
            
            $anggota = new anggota;
            $anggota->nis = $request->nisAnggota;
            $anggota->namaAnggota = $request->namaAnggota;
            $anggota->id_jurusan = $request->jurusan;
            $anggota->password = $password_hash;
            $anggota->noHp = $request->noHp;
            $anggota->save();

            if($anggota){
                return redirect('anggota')->with('toast_success','Data berhasil di tambahkan');
            }
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(anggota $anggota)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(anggota $anggota, $nis)
    {
        $anggota = anggota::where('nis',$nis)->first();
        $jurusan = jurusan::get();
        
        return view('pages.editAnggota', [
            'anggota' => $anggota,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anggota $anggota,$nis)
    {
        $request->validate([
            'namaAnggota' => 'required',
            'jurusan' => 'required',
            'noHp' => 'required|max:14',
        ]);

        try {
            $anggota->where('nis',$nis)->update([
                'namaAnggota' => $request->namaAnggota,
                'id_jurusan' => $request->jurusan,
                'noHp' => $request->noHp
            ]);
            if ($anggota) {
                return redirect('anggota')->with('success', 'Data berhasil di Perbaruhi');
            }
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(anggota $anggota,$nis)
    {
        try {
            $cek = peminjaman::where('nis',$nis)->count();

            if($cek == 0) {
                $anggota = anggota::where('nis',$nis)->delete();
            }else {
                $anggota = false;
            }
            if($anggota) {
                return redirect('anggota')->with('success', 'Data berhasil dihapus');
            }else {
                return redirect('anggota')->with('warning', 'Anggota sedang dalam masa peminjaman buku');
            }
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!');
            
        }
    }

    public function resetPassword($nis)
    {
        try {
            $resetPasswordAnggota = anggota::where('nis',$nis)->update([
                'password' => Hash::make('perpus12345')
            ]);
            if ($resetPasswordAnggota) {
                return redirect('anggota')->with('toast_success', 'Password telah di reset menjadi (perpus12345)');
            }else {
                echo 'gagal';
            }
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error', 'Terdapat data yang tidak memenuhi aturan!');
        }
    }

    
}
