@extends('layout.template')

@section('activeDashboard')
    activeku
@endsection

@section('title')
    Dashboard
@endsection

@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Dashboard
@endsection

@section('link')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/pinjaman', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box card-outline card-success">
            <span class="info-box-icon text-success">
                <i class="fa fa-book"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text"><b>Jumlah Peminjaman</b></span>
                <span class="info-box-number" style="font-size: 18pt">{{$jumlah_peminjaman}}</span>

            </div>
        </div>
      </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/kembali', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box card-outline card-success">
            <span class="info-box-icon text-success">
                <i class="fa fa-check"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text"><b>Jumlah Pengembalian</b></span>
                <span class="info-box-number" style="font-size: 18pt">{{$jumlah_pengembalian}}</span>

            </div>
        </div>
      </a>
    </div>

    

</div>



@endsection









