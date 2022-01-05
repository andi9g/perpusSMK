@extends('layout.template')

@section('activeDataKembali')
    activeku
@endsection

@section('title')
    Data Pengembalian
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Pengembalian
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard', []) }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pengembalian</li>
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
        <th nowrap>Jumlah</th>
        <th>ket</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($buku as $peminjaman)
        <tr style="text-transform: capitalize">
          <td align="center">{{$loop->iteration}}</td>
          <td align="center">{{$peminjaman->kd_buku}}</td>
          <td nowrap>{{$peminjaman->judul_buku}}</td>
          <td align="center">{{$peminjaman->jumlah_pinjam}}</td>
          <td align="center" nowrap>{{$peminjaman->ket}}</td>
          <td align="center">
            {{
              date('d/m/Y',strtotime($peminjaman->created_at))
            }}
          </td>
          <td align="center">
            {{
              date('d/m/Y',strtotime($peminjaman->updated_at))
            }}
          </td>
          
        </tr>
        @endforeach
      
      </tbody>
    </table>
    
  </div>
    
      
</div>
@endsection



