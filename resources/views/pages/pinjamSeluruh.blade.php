@extends('/layout.template')

@section('activeDataPeminjaman')
    activeku
@endsection

@section('title')
    Pinjam Banyak Buku
@endsection



@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Pinjam Banyak Buku
@endsection



@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/peminjaman', []) }}">Peminjaman</a></li>
    <li class="breadcrumb-item active">Pinjam Banyak Buku</li> 
@endsection



@section('content')
   <div class="row">
       <div class="col-md-2"></div>
    <div class="col-md-8 ">

        <div class="card card-outline card-success">
            
            <div class="card-body">
                <h3 class="text-center text-bold" style="color:rgb(1, 138, 1)">
                    Data Peminjaman
                </h3>
                <form class="form-horizontal" action="{{ url('peminjamanKhusus/pinjam') }}" method="post">
                    @csrf
                    <div class="card-body">
                      
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
                                <option value="">-- none --</option>
                              @foreach ($buku as $buku)
                                <option value="{{$buku->kd_buku}}" @if (old("buku")==$buku->id)
                                    selected
                                @endif>{{$buku->kd_buku}} - {{strtoupper($buku->judul_buku)}} - {{strtoupper($buku->tahun)}}</option>
                              @endforeach
                            </select>
                        </div>
        
                        <div class="form-group" style="text-transform: capitalize">
                            <label>Ket.</label>
                                <input type="text" maxlength="150" class="form-control" style="background-color: rgb(209, 255, 188);text-transform: capitalize" name="ket" placeholder="Contoh : Kebutuhan Pembelajaran di Kelas">
                            
                        </div>
                        <div class="form-group" style="text-transform: uppercase">
                            <label>Jumlah Pinjam</label>
                                <input type="number" maxlength="2" class="form-control" style="width: 70px;background-color: rgb(209, 255, 188)" name="jumlah_pinjam" min="1" max="100" value="1">
                            
                        </div>
                    
                    
                    
                      
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer ">
                        <a href="{{ url('peminjaman', []) }}" style="font-size: 20px">
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











