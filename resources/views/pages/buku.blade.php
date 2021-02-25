@extends('layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataBuku')
    activeku2
@endsection

@section('title')
    Data Buku
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Buku
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item active">Data Buku</li>
@endsection



@section('content')

<div class="card card-outline card-success">
  <div class="card-header">
      <div class="row">
        <div class="col text-left">
          <a href="{{ route('buku.create') }}" class="btn btn-success">
              <i class="fa fa-plus"></i> &nbsp;Tambah Buku
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
    <table id="example2" class="table table-sm table-hover table-bordered table-striped tabelku" style="font-size:11pt">
      <thead>
      <tr align="center">
        <th >Kd Buku</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Jenis B.</th>
        <th>Lok. Rak</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($buku as $buku)
        <tr style="text-transform: capitalize">
          <td>{{$buku->kd_buku}}</td>
          <td nowrap>{{$buku->judul_buku}}</td>
          <td nowrap>{{$buku->pengarang}}</td>
          <td nowrap>{{$buku->penerbit}}</td>
          <td nowrap>{{$buku->tahun}}</td>
          <td nowrap>{{$buku->jenis_buku}}</td>
          <td align="center" nowrap>{{$buku->lokasi_rak}}</td>
          <td nowrap>{{$buku->stok}}</td>
          
          <td nowrap class="text-center">
            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-info btn-xs px-2">
              <i class="fa fa-pencil"></i> Edit
            </a>
  
            <form action="{{ route('buku.destroy', $buku->id) }}" method="post" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin dihapus?..')" class="btn btn-danger btn-xs px-2">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
            
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
          <form action="{{ url('/cetak/buku', []) }}" method="post" target="_blank">
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
                <input type="text" id="cari" name="cariCetak" class="form-control" placeholder="id buku/judul/pengarang/penerbit/tahun/jenis buku">
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












