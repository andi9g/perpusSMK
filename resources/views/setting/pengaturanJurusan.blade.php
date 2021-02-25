<div class="row">
    <div class="col-md">
        <div class="bgku2">
            <form action="{{ route('pengaturan.store') }}" method="post">
                @csrf
            <div class="form-group">
                <label for="jurusanset">Tambah Jurusan</label>
                <input type="text" class="form-control" name="jurusan" id="jurusanset" placeholder="Masukan Jurusan" value="{{old("jurusan")}}">
            </div>
            
            <div class="form-group d-block text-right">
                <input type="reset" class="btn btn-secondary" value="reset">
                <button type="submit" class="btn btn-success">Tambah Jurusan</button>
            </div>
            </form>
        </div>

        <table class="table table-sm table-striped table-hover table-bordered">
            <thead class="bg-dark">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusanku as $jurusan)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$jurusan->jurusan}}</td>
                    <td>
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#jurusan{{$jurusan->id}}">
                            <i class="fa fa-sm fa-pencil"></i> Edit
                        </button>
                        
                        <form action="{{ route('pengaturan.destroy', $jurusan->id) }}" method="post" class="d-inline" onclick="return confirm('Yakin dihapus?..')">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-xs">
                                <i class="fa fa-sm fa-trash"></i> Hapus
                            </button>
                        </form>
                       
                    </td>
                </tr>

                <div class="modal fade" id="jurusan{{$jurusan->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Default Modal</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ route('pengaturan.update', $jurusan->id) }}" method="post">
                            @csrf
                            @method('put')
                        <div class="modal-body">
                        
                            <label for="jurusanset">Tambah Jurusan</label>
                            <input type="text" class="form-control" name="jurusanEdit" id="jurusanset" placeholder="Masukan Jurusan" value="{{$jurusan->jurusan}}">


                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                @endforeach
                
                
            </tbody>
        </table>

        

    </div>
</div>