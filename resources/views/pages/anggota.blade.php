@extends('layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataAnggota')
    activeku2
@endsection

@section('title')
    Data Anggota
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Anggota
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item active">Data Anggota</li>
@endsection



@section('content')

<div class="card card-outline card-success">
  <div class="card-header">
      <div class="row">
        <div class="col text-left">
          <a href="{{ route('anggota.create') }}" class="btn btn-success">
              <i class="fa fa-plus"></i> &nbsp;Tambah Anggota 
          </a>
          
        </div>
        <div class="col text-right">

          <button style="button" data-toggle="modal" data-target="#modal-default" class="btn btn-secondary">
            <i class="fa fa-print"></i> &nbsp;Cetak 
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
        <th>Jurusan</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($anggota as $anggota)
        <tr style="text-transform: capitalize">
          <td align="center">{{$anggota->nis}}</td>
          <td nowrap>{{$anggota->namaAnggota}}</td>
          <td align="center" nowrap style="text-transform: uppercase">{{$anggota->jurusan}}</td>
          <td nowrap class="text-center">
            <a href="{{ route('anggota.edit', $anggota->nis) }}" class="btn btn-info btn-xs px-2">
              <i class="fa fa-pencil"></i> Edit
            </a>
  
            <form action="{{ route('anggota.destroy', $anggota->nis) }}" method="post" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin dihapus?..')" class="btn btn-danger btn-xs px-2">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
            
            <a href="{{ url('anggota/resetPassword/'.$anggota->nis) }}" onclick="return confirm('yakin direset?..')" class="btn btn-primary btn-xs px-2">
              <i class="fas fa-key"></i> RePass
            </a>
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
          <form action="{{ url('/cetak/anggota', []) }}" method="post" target="_blank">
            @csrf
          <div class="modal-body">

            
              <div class="form-group">
                <label>Cetak Berdasarkan</label>
                <select class="form-control" onchange="tampilCetak()" name="pilihCetak" id="cetakPilih">
                  <option value="keseluruhan">Keseluruhan</option>
                  <option value="berdasarkan">Berdasarkan</option>
                </select>
              </div>

              <div id="berdasarkanCari" style="display: none" disabled>
                <div class="form-group">
                <label>Cetak Berdasarkan</label>
                <input type="text" id="cari" name="cariCetak" class="form-control" placeholder="Nama/Nis/Jurusan">
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
  </div>
</div>
@endsection












