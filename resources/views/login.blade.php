
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background: url('gambar/background.jpg');filter: brightness()">
<div class="login-box mt-0" style="border-radius: 10px">
    
  <!-- /.login-logo -->
  <div class="login-logo">
    <h2 class="text-success"><b>Login</b></h2>
  </div>
  <div class="card card-outline card-success" >
    <div class="card-body login-card-body my-1 py-1">
        <div class="text-center">
            <p>Sistem Informasi Perpustakaan</p>
        </div>

      <form action="{{ url('/login/proses', []) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control @error('username')
              is-invalid
          @enderror" placeholder="Username atau nis">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password')
              is-invalid
          @enderror" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
              <div class=" mb-3">                  
                  <select name="sebagai" class="form-control" id="">
                      <option value="admin">Admin</option>
                      <option value="anggota">Anggota</option>
                  </select>
                </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
            <div class="col" >
                <a href="{{ url('/welcome', []) }}"><< Kembali</a>
            </div>
        </div>
      </form>

     
    </div>
    
    <!-- /.login-card-body -->
  </div>
  <br>
    <br>
    <br>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
@include('sweetalert::alert')

</body>
</html>
