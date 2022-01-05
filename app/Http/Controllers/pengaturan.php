<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Models\buku;
use App\Models\jenisBuku;
use App\Models\anggota;
use App\Models\admin;
use App\Models\pengaturanLogo;
use App\Models\pengaturanPerpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use File;


class pengaturan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = jurusan::get();
        $jenis_buku = jenisBuku::get();
        return view('pages/pengaturan', [
            'jurusanku' => $jurusan,
            'jenis_buku' => $jenis_buku
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
    public function jenis_buku(Request $request)
    {
        $request->validate([
            'jenis_buku' => 'required',
        ]);
        try {
            $jenis_buku = new jenisBuku;
            $jenis_buku->jenis_buku = $request->jenis_buku;
            $jenis_buku->save();

            if ($jenis_buku) {
                return redirect('pengaturan')->with('toast_success','Data berhasil di tambahkan');
            }

        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
        ]);
        try {
            $jurusan = new jurusan;
            $jurusan->jurusan = $request->jurusan;
            $jurusan->save();

            if ($jurusan) {
                return redirect('pengaturan')->with('toast_success','Data berhasil di tambahkan');
            }

        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */

    public function ubah_jenis(Request $request, $id)
    {
        $request->validate([
            'jenisEdit' => 'required'
        ]);
        try {
            $edit = jenisBuku::where('id',$id)->update([
                'jenis_buku' => $request->jenisEdit
            ]);
            if ($edit) {
                return redirect('pengaturan')->with('toast_success','Data berhasil di Edit');
            }
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }

    public function update(Request $request, jurusan $jurusan,$id)
    {
        $request->validate([
            'jurusanEdit' => 'required'
        ]);
        try {
            $edit = jurusan::where('id',$id)->update([
                'jurusan' => $request->jurusanEdit
            ]);
            if ($edit) {
                return redirect('pengaturan')->with('toast_success','Data berhasil di Edit');
            }
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */

    public function hapus_jenis($id)
    {
        try {
            $data = buku::where('jenis_buku',$id)->count();
            if ($data<=0) {
                $hapus = jenisBuku::where('id',$id)->delete();
                if ($hapus) {
                    return redirect('pengaturan')->with('toast_success','Data berhasil di hapus');
                }
            }else {
                return redirect('pengaturan')->with('warning','Terdapat Buku yang terdaftar pada Jenis terkait');
            }

            
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }

    public function destroy(jurusan $jurusan,$id)
    {
       
        try {
            $data = anggota::where('id_jurusan',$id)->count();
            if ($data<=0) {
                $hapus = jurusan::where('id',$id)->delete();
                if ($hapus) {
                    return redirect('pengaturan')->with('toast_success','Data berhasil di hapus');
                }
            }else {
                return redirect('pengaturan')->with('warning','Terdapat Anggota yang terdaftar pada Jurusan terkait');
            }

            
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
    }
    public function perpus(Request $request)
    {
        try {
            $cek = pengaturanPerpus::count();
            if($cek>0){
                $cek = pengaturanPerpus::first();
                
                $update = pengaturanPerpus::where('id',$cek->id)->update([
                    'nama_perpus' => $request->nama_perpus,
                    'keterlambatan' => $request->keterlambatan
                ]);
                if ($update) {
                    return redirect('pengaturan')->with('toast_success','Data berhasil di Update');
                }
                
            }else {
                $insert = new pengaturanPerpus;
                $insert->nama_perpus = $request->nama_perpus;
                $insert->keterlambatan = $request->keterlambatan;
                $insert->save();
                if ($insert) {
                    return redirect('pengaturan')->with('toast_success','Data berhasil di Update');
                }
            }
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
        
    }
    public function logo(Request $request)
    {
        
        try {
            $logo =  $request->file('logo');
            $format =  $logo->getClientOriginalExtension();
            $size = $logo->getSize();
            $tgl = date('Y-m-d');
            $en = strtotime($tgl);
            $nama_file = $en."_logo_perpus.".$format;
            
            $conv = strtolower($format);
            if($conv == 'jpg'||$conv == 'jpeg'||$conv == 'png'){
                if($size<=2010000){
                    
                    $cekDBC = pengaturanLogo::count();
                    if($cekDBC>0){
                        $cekDB = pengaturanLogo::first();
                        if($cekDB && !empty($cekDB->logo)){
                            File::delete(\base_path() ."/public/gambar".$cekDB->logo);
                        }
                        $hapus = pengaturanLogo::destroy($cekDB->id);
                    }else{
                        $hapus= true;
                    }
                    if($hapus){
                        $logo->move(\base_path() ."/public/gambar",$nama_file);
                        $insert = new pengaturanLogo;
                        $insert->logo = $nama_file;
                        $insert->save();
                        if($insert){
                            return redirect('pengaturan')->with('toast_success','Gambar Logo Berhasil Diubah');
                        }
                    }
    
                }else {
                    return redirect('pengaturan')->with('toast_error','Maximal Size gambar 2Mb');
                }
            }else {
                return redirect('pengaturan')->with('toast_error','File yang diizinkan (jpg,jpeg,png)');
            }
        } catch (\Throwable $th) {
            return redirect('pengaturan')->with('toast_error','terjadi kesalahan');
        }
       
        
    }
    
    public function keluar(Request $request)
    {
        $request->session()->forget('nama_pengguna');
        $request->session()->forget('id');
        $request->session()->forget('nis');
        $request->session()->forget('login');
        $request->session()->forget('status');

        return redirect('/login');
    }


    public function profile(Request $request)
    {
        if($request->session()->get('status')=="admin"){
            $profile = admin::where('id',Session::get('id'))->first();
        }else if($request->session()->get('status')=="anggota"){
            $profile = anggota::where('id',Session::get('id'))->first();
        }
        $foto = empty($profile->foto)?'avatar.png':$profile->foto;
        return view('pages/profile',[
            'foto' => $foto
        ]);
    }
    public function ubahPassword(Request $request)
    {
        try {
            $id = $request->session()->get('id');
            $status = $request->session()->get('status');
            $password1 = $request->password1;
            $password2 = $request->password2;

            if($password1 == $password2){
                if(strlen($password2)>=5){
                    $password = Hash::make($request->password2);
            
                    if($status=='anggota'){
                        $update = anggota::where('id',$id)->update([
                            'password' => $password
                        ]);
                    }else if($status=='admin'){
                        $update = admin::where('id',$id)->update([
                            'password' => $password
                        ]);
                    }

                }else{
                    return redirect('/profile')->with('toast_error','minimal karakter 5 digit');
                }
            }else {
                return redirect('/profile')->with('toast_error','Password salah..');
            }
            
            if($update){
                $request->session()->forget('nama_pengguna');
                $request->session()->forget('id');
                $request->session()->forget('nis');
                $request->session()->forget('login');
                $request->session()->forget('status');
                return redirect('/profile')->with('success','Berhasil.. Silahkan login dengan password baru..');
            }else{
                return redirect('/profile')->with('warning','Gagal merubah password..');

            }
            
        } catch (\Throwable $th) {
            return redirect('/profile')->with('warning','terjadi kesalahan');
        }
        
    }

    public function ubahGambar(Request $request)
    {
        
            $id = $request->session()->get('id');
            $nama = $request->session()->get('nama_pengguna');
            $status = $request->session()->get('status');
    
            $gambar =  $request->file('gambarProfile');
            $format =  $gambar->getClientOriginalExtension();
            $size = $gambar->getSize();
            $tgl = date('Y-m-d');
            $en = strtotime($tgl);
            $nama_file = $en."_gambar_".$id.$nama.".".$format;
    
            $conv = strtolower($format);
            if($conv == 'jpg'||$conv == 'jpeg'||$conv == 'png'){
                if($size <=2000000){
                    if($status == 'admin'){
                        $cek = admin::where('id',$id)->first();
                        if($cek && !empty($cek->foto)){
                            File::delete(\base_path() ."/public/gambar/profile".$cek->foto);
                        }
                        $gambar->move(\base_path() ."/public/gambar/profile",$nama_file);
                        $update = admin::where('id',$id)->update([
                            'foto' => $nama_file
                        ]);
                        
                    }else if($status== 'anggota'){
                        $cek = anggota::where('id',$id)->first();
                        if($cek && !empty($cek->foto)){
                            File::delete(\base_path() ."/public/gambar/profile".$cek->foto);
                        }
                        $gambar->move(\base_path() ."/public/gambar/profile",$nama_file);
                        $update = anggota::where('id',$id)->update([
                            'foto' => $nama_file
                        ]);
                    }
                }else {
                    return redirect('/profile')->with('toast_error','Max.. Gambar 2Mb..');
                }
            }else {
                return redirect('/profile')->with('toast_error','Format yang di dukung (jpg,jpeg & png)');
            }
            
            if ($update) {
                return redirect('/profile')->with('success','Gambar berhasil di ubah..');
            }
        


    }
}
