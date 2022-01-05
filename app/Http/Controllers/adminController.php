<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admin = admin::when($request->keyword, function($query) use ($request){
            $query->where('nama_admin','like',"%{$request->keyword}%")
                ->orWhere('username','like',"%{$request->keyword}%");
        })->orderBy('nama_admin')
        ->paginate($request->limit ? $request->limit : 10);

        $admin->appends($request->only('keyword','limit'));

        return view('pages.admin',[
            'admin' => $admin
        ]);

        
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tambahAdmin');
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
            'nama_admin' => 'required',
            'password' => 'required|regex:/^\S*$/u',
            'username' => 'required|regex:/^\S*$/u',
        ]);

        try {
            $password2 = Hash::make($request->password);
            $tambah = new admin;
            $tambah->nama_admin = $request->nama_admin;
            $tambah->username = $request->username;
            $tambah->password = $password2;
            $tambah->save();
            if($tambah){
                return redirect('admin')->with('success','Data Berhasil ditambahkan');
            }
        } catch (\Throwable $th) {
            return redirect('admin/create')->with('toast_error','Terjadi Kesalan...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        return view('pages.editAdmin',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        $request->validate([
            'nama_admin' => 'required',
        ]);

        try {
            
            $edit = admin::where('id',$admin->id)->update([
                'nama_admin' => $request->nama_admin
            ]);

            if ($edit) {
                return redirect('admin')->with('toast_success','Data Berhasil ditambahkan');
            }
        } catch (\Throwable $th) {
            return redirect('admin')->with('toast_error','Terjadi Kesalan...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        try {
            $hapus = admin::destroy($admin->id);

            if ($hapus) {
                return redirect('admin')->with('toast_warning','Data Berhasil dihapus!');
            }
        } catch (\Throwable $th) {
            return redirect('admin')->with('toast_error','Terjadi Kesalan...');
        }
    }

    public function resetPassword($id_admin)
    {

        try {
            $password_default = Hash::make('admin12345');

            $reset = admin::where('id',$id_admin)->update([
                'password' => $password_default
            ]);
            if ($reset) {
                return redirect('admin')->with('toast_success','Password berhasil di reset!');
            }

        } catch (\Throwable $th) {
            return redirect('admin')->with('toast_error','Terjadi Kesalan...');
        }
        
    }
}
