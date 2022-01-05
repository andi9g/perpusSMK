@extends('layout.template')

@section('activeDataPinjaman')
    activeku
@endsection

@section('title')
    Data Pinjaman
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Pinjaman
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Peminjaman</li>
@endsection



@section('content')
<div class="card card-outline card-success">
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-sm table-hover table-bordered table-striped tabelku">
      <thead>
      <tr align="center">
          <th>No</th>
        <th>Kd Buku</th>
        <th>Judul Buku</th>
        <th>Tgl Pinjam</th>
        <th>Jml</th>
        <th>Ket</th>
        <th>Masa</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($buku as $peminjaman)
        <tr style="text-transform: capitalize">
          <td align="center">{{$loop->iteration}}</td>
          <td align="center">{{$peminjaman->kd_buku}}</td>
          <td nowrap>{{$peminjaman->judul_buku}}</td>
          <td align="center">
            {{
              date('d/m/Y',strtotime($peminjaman->created_at))
            }}
          </td>
          <td align="center">{{$peminjaman->jumlah_pinjam}}</td>
          <td align="center">
            {{$peminjaman->ket}}
          </td>
          <td align="center" nowrap>
            @php
              $hari = DB::table('tb_pengaturan')->first();
                $tgl_pinjam = strtotime($peminjaman->created_at);
                if($peminjaman->ket == "-"){
                  $masa_pinjam = strtotime('+'.$hari->keterlambatan.' days',strtotime($peminjaman->created_at));
                }else {
                  $masa_pinjam = strtotime('+1 days',strtotime($peminjaman->created_at));
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
          
        </tr>
        @endforeach
      
      </tbody>
    </table>
    
  </div>
    
      
</div>
@endsection



