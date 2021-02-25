@extends('layout.template')

@section('activeDataPeminjaman')
    activeku
@endsection

@section('title')
    Data Peminjaman
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Peminjaman
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item active">Data Peminjaman</li>
@endsection



@section('content')

<div class="card card-outline card-success">
  <div class="card-header">
      <div class="row">
        <div class="col">
            <button style="button" data-toggle="modal" data-target="#tambah_peminjaman" class="btn btn-success btn-md">
              <i class="fas fa-book"></i> &nbsp;Pinjam Buku
            </button>
        </div>
        <div class="col">
            <a href="{{ url('/peminjamanKhusus', []) }}" class="btn btn-danger btn-md">
              <i class="fas fa-book"></i> &nbsp;Pinjam Buku Khusus
            </a>
        </div>
        
        <div class="col text-right">

          <button style="button" data-toggle="modal" data-target="#modal-default" class="btn btn-secondary">
            <i class="fa fa-print"></i> &nbsp;Cetak 
          </button>
        </div>

        

      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-sm table-hover table-bordered table-striped tabelku">
      <thead>
      <tr align="center">
        <th>Nis</th>
        <th>Nama Anggota</th>
        <th>Kd Buku</th>
        <th>Judul Buku</th>
        <th>Tgl Pinjam</th>
        <th>Jml</th>
        <th>Ket</th>
        <th>Masa</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($peminjaman as $peminjaman)
        <tr style="text-transform: capitalize">
          <td align="center">{{$peminjaman->nis}}</td>
          <td nowrap>{{$peminjaman->namaAnggota}}</td>
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
    

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              <i class="fa fa-print"></i>
              Cetak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ url('/cetak/peminjaman', []) }}" method="post" target="_blank">
            @csrf
          <div class="modal-body">

            
              <div class="form-group">
                <label>Cetak Berdasarkan</label>
                <select class="form-control" onchange="tampilCetak()" name="pilihCetak" id="cetakPilih">
                  <option value="keseluruhan">Peminjaman Satuan (keseluruhan)</option>
                  <option value="berdasarkan">Peminjaman Satuan (berdasarkan)</option>
                  <option value="peminjamanKhusus"><b>Peminjaman Khusus (keseluruhan)</b></option>
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

    </script> 


    <div class="modal fade" id="tambah_peminjaman">
        <div class="modal-dialog" >
          <div class="modal-content" >
            <div class="modal-header text-black" style="background-color: rgb(233, 233, 233)">
              <h4 class="modal-title ">
                <i class="fa fa-user"></i>
                Tambah Peminjam</h4>
              <button type="button" class="close text-success" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('peminjaman.store') }}" method="post">
              @csrf
            <div class="modal-body">
  
                <div class="form-group" style="text-transform: uppercase">
                    <label>Identitas Peminjam</label>
                    <select class="form-control select2" name="id_anggota" style="width: 100%;">
                        <option value="">-- none --</option>
                      @foreach ($anggota as $anggota)
                        <option value="{{$anggota->nis}}" style="text-transform: capitalize" @if (old("anggota")==$anggota->nis)
                            selected
                        @endif>{{$anggota->nis}} - {{strtoupper($anggota->namaAnggota)}} - {{strtoupper($anggota->jurusan)}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group" style="text-transform: uppercase">
                    <label>Identitas Buku</label>
                    <select class="form-control select2 @error('buku')
                        is-invalid
                    @enderror" name="id_buku" style="width: 100%;">
                        <option value="" >-- none --</option>
                      @foreach ($buku as $buku)
                        <option value="{{$buku->kd_buku}}"  @if (old("buku")==$buku->id)
                            selected
                        @endif>{{strtoupper($buku->kd_buku)}} - {{strtoupper($buku->judul_buku)}} </option>
                      @endforeach
                    </select>
                </div>

                
                
                
                
  
            </div>
            <div class="modal-footer justify-content-between" style="background-color: rgb(243, 243, 243)">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" name="cetak" class="btn btn-success">Tambah Pinjaman</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      
  </div>
</div>
@endsection



