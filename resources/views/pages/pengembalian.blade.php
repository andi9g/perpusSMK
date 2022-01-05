@extends('layout.template')

@section('activeDataPengembalian')
    activeku
@endsection

@section('title')
    Pengembalian Buku
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Pengembalian
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/peminjaman', []) }}">Data Peminjaman</a></li>
    <li class="breadcrumb-item active">Pengembalian</li>
@endsection



@section('content')

<div class="card card-outline card-success">
  
  <!-- /.card-header -->
  <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <form action="{{ url()->current() }}" class="d-inline">
            <div class="form-group top_search">
              <div class="input-group">
                  <input type="text" class="form-control bgku3" name="keyword" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default"  type="button">Search</button>
                  </span>
                </div>
              </div>
            </form>
        </div>
      </div>

    <table id="example2" class="table table-sm table-hover table-bordered table-striped tabelku" style="font-size: 12pt">
      <thead>
      <tr align="center">
        <th>Nis</th>
        <th>Nama Anggota</th>
        <th>Kd Buku</th>
        <th>Judul Buku</th>
        <th>Tgl Pinjam</th>
        <th>Jml</th>
        <th>Masa</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($peminjaman as $tampil)
        @if ($tampil->status == 'pinjam')
        <tr style="text-transform: capitalize">
          <td align="center">{{$tampil->nis}}</td>
          <td nowrap>{{$tampil->namaAnggota}}</td>
          <td align="center">{{$tampil->kd_buku}}</td>
          <td nowrap>{{$tampil->judul_buku}}</td>
          <td align="center">
            {{
              date('d/m/Y',strtotime($tampil->created_at))
            }}
          </td>
          <td align="center">{{$tampil->jumlah_pinjam}}</td>
          <td align="center" nowrap>
            @php
              $hari = DB::table('tb_pengaturan')->first();
                $tgl_pinjam = strtotime($tampil->created_at);
                if($tampil->ket == "-"){
                  $masa_pinjam = strtotime('+'.$hari->keterlambatan.' days',strtotime($tampil->created_at));
                }else {
                  $masa_pinjam = strtotime('+1 days',strtotime($tampil->created_at));
                }
                $tgl_sekarang = strtotime('now');

                $total_jumlah = number_format(($tgl_sekarang - $masa_pinjam)/86400);

                if ($total_jumlah<0) {
                  $keterlambatan = $total_jumlah * -1;
                  if($keterlambatan>=3){
                    echo "<font class='text-success text-bold'>".$keterlambatan." Hari Lagi..</font>";
                  }else{
                    echo "<font class='text-warning text-bold'>".$keterlambatan." Hari Lagi!</font>";
                  }
                }else if($total_jumlah==0){
                  echo "<font class='text-warning text-bold'>Ini Hari Terakhir!!</font>";
                }else{
                  echo "<font class='text-danger text-bold'>".$total_jumlah." Hari Terlambat</font>";
                }
            @endphp
          </td>
          <td>
              <form action="{{ route('peminjaman.destroy', $tampil->id) }}" method="post">
                @csrf
                @method('DELETE')
                    <button type="submit" onclick="return confirm('Tekan Oke untuk melanjutkan Proses')" class="btn btn-xs btn-danger btn-block py-0 my-0">Selesai</button>
                </form>
          </td>
          
        </tr>
            
        @endif
        @endforeach
      
      </tbody>
    </table>

    <div class="row align-content-center justify-content-center">
      <div class="col-12">
        <div class="card-body float-right">
          {{ $peminjaman->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>


    
      
      
  </div>
</div>
@endsection



