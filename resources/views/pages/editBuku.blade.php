@extends('/layout.template')

@section('activeDataPerpus')
    activeku
@endsection
@section('activeDataBuku')
    activeku2
@endsection

@section('title')
    Edit Buku
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Edit Buku
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/buku', []) }}">Data Buku</a></li>
    <li class="breadcrumb-item active">Edit Buku</li> 
@endsection



@section('content')
   <div class="row">
       <div class="col-md-2"></div>
    <div class="col-md-8 ">

        <div class="card card-outline card-success">
            
            <div class="card-body">
                <h3 class="text-center text-bold" style="color:rgb(1, 138, 1)">
                    DATA BUKU
                </h3>
                <form class="form-horizontal" action="{{ route('buku.update',['buku' => $buku->id]) }}" method="post" >
                    @csrf
                    @method('PATCH')
                    <div class="card-body" >
                      
                    <div class="form-group row">
                        <label for="kd_buku" class="col-sm-2 col-form-label">Kode Buku</label>
                        <div class="col-sm-10">
                          <input type="text" disabled class="form-control disabled @error('kd_buku')
                              is-invalid
                          @enderror" id="kd_buku" style="text-transform: uppercase" name="kd_buku" placeholder="KD00x" value="{{$buku->kd_buku}}">
                          @error('kd_buku')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('judul_buku')
                              is-invalid
                          @enderror" id="judul_buku" style="text-transform: capitalize" name="judul_buku" placeholder="judul buku" value="{{$buku->judul_buku}}">
                          @error('judul_buku')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('pengarang')
                              is-invalid
                          @enderror" id="pengarang" style="text-transform: capitalize" name="pengarang" placeholder="pengarang" value="{{$buku->pengarang}}">
                          @error('pengarang')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('penerbit')
                              is-invalid
                          @enderror" id="penerbit" style="text-transform: capitalize" name="penerbit" placeholder="penerbit" value="{{$buku->penerbit}}">
                          @error('penerbit')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control @error('tahun')
                              is-invalid
                          @enderror" id="tahun"  name="tahun" placeholder="tahun" value="{{$buku->tahun}}">
                          @error('tahun')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="jenis_buku" class="col-sm-2 col-form-label">J. Buku</label>
                      <div class="col-sm-10">
                        <select name="jenis_buku" id="jenis_buku" class="form-control" required>
                          <option value="">-- none --</option>
                          @foreach ($jenis_buku as $jenis_buku)
                              <option value="{{ $jenis_buku->id }}" @if ($buku->jenis_buku==$jenis_buku->id)
                                  selected
                              @endif>{{ ucwords($jenis_buku->jenis_buku) }}</option>
                          @endforeach
                        </select>
                        @error('jenis_buku')
                          <span class="pesan_error">{{$message}}</span>  
                        @enderror
                      </div>
                  </div>
                    <div class="form-group row">
                        <label for="lokasi_rak" class="col-sm-2 col-form-label">Lokasi Rak</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control @error('lokasi_rak')
                              is-invalid
                          @enderror" id="lokasi_rak" style="text-transform: capitalize" name="lokasi_rak" placeholder="lokasi rak" value="{{$buku->lokasi_rak}}">
                          @error('lokasi_rak')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control @error('stok')
                              is-invalid
                          @enderror" id="stok"  name="stok" placeholder="stok" value="{{$buku->stok}}">
                          @error('stok')
                            <span class="pesan_error">{{$message}}</span>  
                          @enderror
                        </div>
                    </div>
                    
                    
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        <a href="{{ url('buku', []) }}" style="font-size: 20px">
                            <i class="fa fa-angle-double-left"></i>
                            &nbsp;Kembali
                        </a>
                      <button type="submit" class="btn btn-success float-right mx-2 ">Edit</button>
                      <button type="reset" class="btn btn-secondary float-right mx-2">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                  </form>

            </div>
        </div>

    </div>
</div>
@endsection











