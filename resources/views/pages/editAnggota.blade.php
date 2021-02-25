@extends('/layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataAnggota')
    activeku2
@endsection

@section('title')
    Edit Data Anggota
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Edit Data Anggota
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/anggota', []) }}">Data Anggota</a></li>
    <li class="breadcrumb-item active">Edit Data Anggota</li> 
@endsection



@section('content')
   <div class="row">
       <div class="col-md-2"></div>
    <div class="col-md-8 ">

        <div class="card card-outline card-success">
            
            <div class="card-body">
                <h3 class="text-center text-bold" style="color:rgb(1, 138, 1)">
                    IDENTITAS ANGGOTA
                </h3>
                <form class="form-horizontal" action="{{ route('anggota.update',$anggota->nis) }}" method="post">

                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      
                    <div class="form-group row">
                        <label for="nisAnggota" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                          <input type="number" disabled class="form-control disabled @error('nisAnggota')
                              is-invalid
                          @enderror" id="nisAnggota" name="nisAnggota" placeholder="0xx." value="{{$anggota->nis}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="namaAnggota" class="col-sm-2 col-form-label">Nama Anggota</label>
                        <div class="col-sm-10">
                          <input type="text" style="text-transform: capitalize" class="form-control @error('namaAnggota')
                              is-invalid
                          @enderror" id="namaAnggota" name="namaAnggota" placeholder="Nama Anggota" value="{{$anggota->namaAnggota}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select name="jurusan" class="form-control">
                                @foreach ($jurusan as $jurusan)
                                <option value="{{$jurusan->id}}" @if ($jurusan->id == $anggota->id_jurusan)
                                    selected
                                @endif>{{$jurusan->jurusan}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="noHp" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control @error('noHp')
                              is-invalid
                          @enderror" id="noHp" name="noHp" placeholder="081234567xxx" value="{{$anggota->noHp}}">
                        </div>
                    </div>
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        <a href="{{ url('anggota', []) }}" style="font-size: 20px">
                            <i class="fa fa-angle-double-left"></i>
                            &nbsp;Kembali
                        </a>
                      <button type="submit" class="btn btn-success float-right mx-2 px-5">Ubah</button>
                      <button type="reset" class="btn btn-secondary float-right mx-2">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                  </form>

            </div>
        </div>

    </div>
</div>
@endsection











