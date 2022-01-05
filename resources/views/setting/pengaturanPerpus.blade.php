
<form class="form-horizontal" action="{{ url('/pengaturanPerpus', []) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 mt-1 text-center">
        <img src="gambar/{{empty($dblogo->logo)?'error':$dblogo->logo}}" width="90px">
    </div>
    <div class="card-body">
      <div class="form-group row">
        <label for="nama_perpus" class="col-sm-4 col-form-label">Nama Perpus</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nama_perpus" name="nama_perpus" placeholder="nama perpus" value="{{empty($dbPengaturan->nama_perpus)?'':$dbPengaturan->nama_perpus}}">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="keterlambatan" class="col-sm-4 col-form-label">Max. Peminjaman</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" id="keterlambatan" name="keterlambatan" placeholder="Max Keterlambatan (hari)" value="{{empty($dbPengaturan->keterlambatan)?'':$dbPengaturan->keterlambatan}}">
        </div>
        <div class="col-sm-2 text-bold" style="font-size:15pt">
            *Hari
        </div>
      </div>
      
      
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <button type="submit" class="btn btn-success float-right">Update Perpus</button>
    </div>
    <!-- /.card-footer -->
  </form>