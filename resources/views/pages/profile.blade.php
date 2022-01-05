@extends('layout.template')

@section('title')
    Profile
@endsection

@section('namaMenu')
    <i class="fa fa-lg fa-angle-double-right"></i> Profile
@endsection

@section('link')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard', []) }}">dashboard</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-success card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid"
                 src="gambar/profile/"
                 alt="User profile picture"
                 style="min-height: 90px">
          </div>

          <h3 class="profile-username text-center" style="text-transform: capitalize">Nama Pengguna</h3>

          <p class="text-muted text-center">User</p>

          

          <button type="submit" data-toggle="modal" data-target="#ubah_profile" class="btn btn-success btn-block nav-link"><b>Ubah Gambar</b></button>

          <div class="modal fade" id="ubah_profile">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Ubah Gambar</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ url('/profile/ubahGambar', []) }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="gambarProfile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <button type="submit" class="input-group-text bg-primary" id="">Upload</button>
                        </div>
                      </div>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-outline card-success">
        <div class="card-header">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link"><b>UBAH PASSWORD</b></a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              
              <div class="post">
                <form class="form-horizontal" action="{{ url('/profile/ubahpassword', []) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                      <label for="inputPassword1" class="col-sm-3 col-form-label">Password Baru</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" onkeyup="cek()" name="password1" id="inputPassword1" placeholder="password baru">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword2" class="col-sm-3 col-form-label">Ulangi Password Baru</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" onkeyup="cek();" name="password2" id="inputPassword2" placeholder="ulangi password baru">
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <button type="submit" class="btn btn-danger">Ubah Password</button>
                        </div>
                      </div>
                </form>

                <script>
                    function cek(){
                        var pass1 = document.getElementById('inputPassword1').value;
                        var pass2 = document.getElementById('inputPassword2').value;

                        if(pass1.length >=5 ){
                                document.getElementById('inputPassword1').className="form-control";
                            if(pass1 == pass2){
                                document.getElementById('inputPassword1').className="form-control is-valid";
                                document.getElementById('inputPassword2').className="form-control is-valid";
                            }else if(pass2.length == 0){
                                document.getElementById('inputPassword2').className="form-control";

                            }else {
                                 document.getElementById('inputPassword2').className="form-control is-invalid";
                            }
                        }else if(pass1.length==0){
                                document.getElementById('inputPassword1').className="form-control";
                        }else {
                            document.getElementById('inputPassword1').className="form-control is-invalid";

                        }
                       

                    }
                </script>
               
              </div>
              <!-- /.post -->
            </div>
            
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>


@endsection









