@extends('layout.template')

@section('activeHome')
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
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/anggota', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box">
            <span class="info-box-icon text-success">
                <i class="fa fa-users"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Anggota</span>
                <span class="info-box-number" style="font-size: 18pt">{{$jumlah_anggota}}</span>

            </div>
        </div>
      </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/buku', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box">
            <span class="info-box-icon text-success">
                <i class="fa fa-book"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Jumlah Buku</span>
                <span class="info-box-number" style="font-size: 18pt">{{$jumlah_buku}}</span>

            </div>
        </div>
      </a>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/peminjaman', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box">
            <span class="info-box-icon text-success">
                <i class="fa fa-hourglass-1"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Peminjaman Hari Ini</span>
                <span class="info-box-number" style="font-size: 18pt">{{$total_pinjam_hari_ini}}</span>

            </div>
        </div>
      </a>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <a href="{{ url('/pengembalian', []) }}" class="hoverkuHome" style="text-decoration: none;color: black">
        <div class="info-box">
            <span class="info-box-icon text-success" >
                <i class="fa fa-calendar-times-o"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Pengembalian Hari Ini</span>
                <span class="info-box-number" style="font-size: 18pt">{{$total_kembali_hari_ini}}</span>

            </div>
        </div>
      </a>
    </div>


</div>


<div class="row">
    <div class="col-md-8">
        <div class="card">
          <div class="card-header border-0 pb-0 mb-2">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Chart Peminjaman & Pengembalian</h3>
              <h4 class="text-right text-success text-bold">{{date("Y")}}</h4>
            </div>
            
          </div>
    
            <div class="position-relative mb-2 ">
              <canvas id="sales-chart" height="250" class="px-2"></canvas>
            </div>
    
            <div class="d-flex flex-row justify-content-end px-2">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> Peminjaman
              </span>
    
              <span>
                <i class="fas fa-square text-success"></i> Pengembalian
              </span>
            </div>
          </div>
    </div>

    <div class="col-md-4">
      <div class="card">
          <div class="m-3 " >
            <button type="button" data-toggle="modal" data-target="#cetak-pengembalian-keseluruhan" class="btn btn-success btn-block">
              <i class="fa fa-print"></i> &nbsp;Cetak <b style="color:gold">PENGEMBALIAN</b> 
            </button>
            <button type="button" data-toggle="modal" data-target="#cetak-peminjaman-keseluruhan" class="btn btn-primary btn-block">
              <i class="fa fa-print"></i> &nbsp;Cetak <b style="color:gold">PEMINJAMAN</b> 
            </button>
          </div>
      </div>
    </div>
</div>






<div class="modal fade" id="cetak-pengembalian-keseluruhan">
  <div class="modal-dialog">
    <div class="modal-content card-outline card-success">
      <div class="modal-header card-outline card-success">
        <h4 class="modal-title">
          <i class="fa fa-print"></i>
          <b>CETAK PENGEMBALIAN</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/cetak/pengembalian', []) }}" method="post" target="_blank">
        @csrf
      <div class="modal-body">

        
          <div class="form-group">
            <label>Cetak Berdasarkan</label>
            <select class="form-control" onchange="tampilCetak()" name="pilihCetak" id="cetakPilih">
              <option value="keseluruhan">Pengembalian (keseluruhan)</option>
              <option value="berdasarkan">Pengembalian (berdasarkan)</option>
            </select>
          </div>

          <div id="berdasarkanCari" style="display: none" disabled>
            <div class="form-group">
            <label>Cetak Berdasarkan</label>
            <input type="text" id="cari" name="cariCetak" class="form-control" placeholder="nama/judul/1999-01-22/1999-01/1999">
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="cetak" class="btn btn-success">Cetak</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="cetak-peminjaman-keseluruhan">
  <div class="modal-dialog">
    <div class="modal-content card-outline card-primary">
      <div class="modal-header card-outline card-primary">
        <h4 class="modal-title">
          <i class="fa fa-print"></i>
          <b>CETAK PEMINJAMAN</b> 
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/cetak/peminjam', []) }}" method="post" target="_blank">
        @csrf
      <div class="modal-body">

        
          <div class="form-group">
            <label>Cetak Berdasarkan</label>
            <select class="form-control" onchange="tampilCetak2()" name="pilihCetak" id="cetakPilih2">
              <option value="keseluruhan">peminjaman (keseluruhan)</option>
              <option value="berdasarkan">Peminjaman (berdasarkan)</option>
            </select>
          </div>

          <div id="berdasarkanCari2" style="display: none" disabled>
            <div class="form-group">
            <label>Cetak Berdasarkan</label>
            <input type="text" id="cari" name="cariCetak" class="form-control" placeholder="nama/judul/1999-01-22/1999-01/1999">
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="cetak" class="btn btn-success">Cetak</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>
  function tampilCetak()
  {
    var tampil = document.getElementById("cetakPilih").value;
    if(tampil=="berdasarkan"){
      document.getElementById("berdasarkanCari").style.display="block";
      document.getElementById("berdasarkanCari").disabled=false;
    }else{
      document.getElementById("berdasarkanCari").style.display="none";
      document.getElementById("berdasarkanCari").disabled=true;

    }
  }
  function tampilCetak2()
  {
    var tampil = document.getElementById("cetakPilih2").value;
    if(tampil=="berdasarkan"){
      document.getElementById("berdasarkanCari2").style.display="block";
      document.getElementById("berdasarkanCari2").disabled=false;
    }else{
      document.getElementById("berdasarkanCari2").style.display="none";
      document.getElementById("berdasarkanCari2").disabled=true;

    }
  }

</script> 
@endsection



@section('chart')
<script>
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['JAN','FEB','MAR','APR','MAI','JUN','JUL','AUG','SEP','OKT','NOV','DES'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: {{$jumlah_pinjam_bulan}}
        },
        {
          backgroundColor: '#28A745',
          borderColor: '#28A745',
          data: {{$jumlah_kembali_bulan}}
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
           //display: false,
          gridLines: {
            display: true,
            lineWidth: '10px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: {{$jumlah}}
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: true
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  
})

</script>  
@endsection






