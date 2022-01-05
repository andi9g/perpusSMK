@extends('layout.template')

@section('activePengaturan')
    active
@endsection

@section('title')
    Pengaturan
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Pengaturan
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item active">Pengaturan</li>
@endsection

@section('content')
@php
    $dblogo = DB::table('tb_logo')->first();
    $dbPengaturan = DB::table('tb_pengaturan')->first();
@endphp

    <div class="row">
        <div class="col-md-5">
            <div class="card card-outline card-success p-3">
               @include('setting.pengaturanJurusan')
            </div>
            <div class="card card-outline card-success p-3">
               @include('setting.pengaturanLogo')
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-outline card-success p-3">
                @include('setting.pengaturanJenis')
             </div>
            <div class="card card-outline card-success p-3">
               @include('setting.pengaturanPerpus')
            </div>
        </div>
    </div>
@endsection