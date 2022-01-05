@extends('layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataAdmin')
    activeku2
@endsection

@section('title')
    Data Admin
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Data Admin
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item active">Data Admin</li>
@endsection



@section('content')

<div class="card card-outline card-success">
  <div class="card-header">
      <div class="row">
        <div class="col text-left">
          <a href="{{ route('admin.create') }}" class="btn btn-success">
              <i class="fa fa-plus"></i> &nbsp;Tambah Admin
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

    <table id="example2" class="table table-sm table-hover table-bordered table-striped tabelku">
      <thead>
      <tr align="center">
        <th>No</th>
        <th>Nama Admin</th>
        <th>Username</th>
        <th>Password</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($admin as $tampil)
        <tr style="text-transform: capitalize">
          <td align="center">{{$loop->iteration}}</td>
          <td nowrap>{{$tampil->nama_admin}}</td>
          <td nowrap align="center">{{$tampil->username}}</td>
          <td nowrap align="center">
              @if (Hash::check('admin12345',$tampil->password))
                  default
              @else
                  Not Default
              @endif
          </td>
          
          <td nowrap class="text-center">
            <a href="{{ route('admin.edit', $tampil->id) }}" class="btn btn-info btn-xs px-2">
              <i class="fa fa-pencil"></i> Edit
            </a>
  
            <form action="{{ route('admin.destroy', $tampil->id) }}" method="post" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin dihapus?..')" class="btn btn-danger btn-xs px-2">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </form>
            <form action="{{ url('admin/resetPassword', $tampil->id) }}" method="post" class="d-inline">
              @csrf
              @method('HEAD')
              <button type="submit" onclick="return confirm('Yakin direset?..')" class="btn btn-success btn-xs px-2">
                <i class="fas fa-key"></i> Reset
              </button>
            </form>

            
          </td>
        </tr>
        @endforeach
      
      </tbody>
    </table>

    <div class="row align-content-center justify-content-center">
      <div class="col-12">
        <div class="card-body float-right">
          {{ $admin->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>

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
          <form action="{{ url('/cetak/admin', []) }}" method="post" target="_blank">
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
                <input type="text" id="cari" name="cariCetak" class="form-control" placeholder="nama/username/1999-01-22/1999-01/1999">
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
