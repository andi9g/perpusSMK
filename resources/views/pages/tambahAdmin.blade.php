@extends('/layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataAdmin')
    activeku2
@endsection

@section('title')
    Tambah Admin
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Tambah Admin
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin', []) }}">Data Admin</a></li>
    <li class="breadcrumb-item active">Tambah Admin</li> 
@endsection



@section('content')
   <div class="row">
       <div class="col-md-2"></div>
    <div class="col-md-8 ">

        <div class="card card-outline card-success">
            
            <div class="card-body">
                <h3 class="text-center text-bold" style="color:rgb(1, 138, 1)">
                    IDENTITAS Admin BARU
                </h3>
                <form class="form-horizontal" action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                      
                    <div class="form-group row">
                        <label for="nama_admin" class="col-sm-2 col-form-label">Nama Admin</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('nama_admin')
                              is-invalid
                          @enderror" id="nama_admin" name="nama_admin" placeholder="nama admin" value="{{old('nama_admin')}}">
                          @error('nama_admin')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('username')
                              is-invalid
                          @enderror" id="username" name="username" placeholder="username" value="{{old('username')}}">
                          @error('username')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control @error('password')
                              is-invalid
                          @enderror" id="password" name="password" placeholder="password" value="{{old('password')}}">
                          @error('password')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    
                    
                    
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        <a href="{{ url('admin', []) }}" style="font-size: 20px">
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











