@extends('/layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataAnggota')
    activeku2
@endsection

@section('title')
    Tambah Anggota
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Tambah Anggota
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/anggota', []) }}">Data Anggota</a></li>
    <li class="breadcrumb-item active">Tambah Anggota</li> 
@endsection



@section('content')
   <div class="row">
       <div class="col-md-2"></div>
    <div class="col-md-8 ">

        <div class="card card-outline card-success">
            
            <div class="card-body">
                <h3 class="text-center text-bold" style="color:rgb(1, 138, 1)">
                    IDENTITAS ANGGOTA BARU
                </h3>
                <form class="form-horizontal" action="{{ route('anggota.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                      
                    <div class="form-group row">
                        <label for="nisAnggota" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control @error('nisAnggota')
                              is-invalid
                          @enderror" id="nisAnggota" name="nisAnggota" placeholder="0xx." value="{{old('nisAnggota')}}">
                          @error('nisAnggota')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="namaAnggota" class="col-sm-2 col-form-label">Nama Anggota</label>
                        <div class="col-sm-10">
                          <input type="text" style="text-transform: capitalize" class="form-control @error('namaAnggota')
                              is-invalid
                          @enderror" id="namaAnggota" name="namaAnggota" placeholder="Nama Anggota" value="{{old('namaAnggota')}}">
                          @error('namaAnggota')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select name="jurusan" class="form-control">
                                @foreach ($jurusan as $jurusan)
                                <option value="{{$jurusan->id}}" @if (old('jurusan')==$jurusan->id)
                                    selected
                                @endif>{{$jurusan->jurusan}}</option>
                                @endforeach
                                
                            </select>
                            
                          @error('jurusan')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="noHp" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control @error('noHp')
                              is-invalid
                          @enderror" id="noHp" name="noHp" placeholder="081234567xxx" value="{{old('noHp')}}">
                          @error('noHp')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        <a href="{{ url('anggota', []) }}" style="font-size: 20px">
                            <i class="fa fa-angle-double-left"></i>
                            &nbsp;Kembali
                        </a>
                      <button type="submit" class="btn btn-success float-right mx-2 ">Tambah</button>
                      <button type="reset" class="btn btn-secondary float-right mx-2">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                  </form>

            </div>
        </div>

    </div>
</div>
@endsection











