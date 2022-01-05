
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SI Perpustakaan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v1.5.1
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background:url('gambar/background.jpg')">

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none text-success bg-light p-2 rounded-circle"><i class="icofont-navigation-menu text-success"></i></button>

  <!-- ======= Header ======= -->
  <header id="header" >
    <div class="d-flex flex-column" >

      <div class="profile p-3">
        <img src="gambar/{{empty($logo->logo)?'':$logo->logo}}" alt="" class="img-fluid" style="border:none;width: 90px">

        {{-- <hr color="white" class="my-0"> --}}
        <div class="social-links my-0 py-0 text-center text-light">
          <p class="my-0 py-0">Sistem Informasi Perpustakaan</p>
        </div>
        <hr color="white" class="my-0">
        <h1 class="text-success text-center"><a href="{{ url('/welcome', []) }}" >{{empty($perpus->nama_perpus)?'none':$perpus->nama_perpus}}</a></h1>
        
      </div>

      <nav class="nav-menu mt-0 py-2">
        <ul>
            <li class="active"><a href="#about"><i class="bx bx-book"></i> <span>Daftar Buku</span></a></li>
              
            @if ($perangkat > 0)
            @php
                $perangkat = $_SERVER['HTTP_USER_AGENT'];
                $ambil1 = explode(')', $perangkat);
                $perangkat = $ambil1[0];

                $ambil = DB::table('perangkat')->first();
                
            @endphp
            @if ($ambil->perangkat == $perangkat)
            <li><a href="{{ route('halaman.pengunjung') }}"><i class="bx bx-edit"></i> <span>Daftar Pengunjung</span></a></li>
            @endif
              
            @else 
            <li><a href="{{ route('halaman.pengunjung') }}"><i class="bx bx-edit"></i> <span>Daftar Pengunjung</span></a></li>
            @endif
            
            <li><a href="{{ url('/login', []) }}"><i class="bx bx-lock"></i> <span>Login</span></a></li>

        </ul>
      </nav><!-- .nav-menu -->
      

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  {{-- style="background: url('gambar/{{$logo->logo}}'); " --}}
  <section class="d-flex flex-column justify-content-center py-2 align-items-center" style="background:url('gambar/background.jpg');filter: brightness(87%) " >
    <div class="hero-container cssku"  data-aos="fade-in">
      <h1 class="my-0 py-0 text-success" style="color: rgb(29, 199, 29) !important"><b>SELAMAT DATANG </b></h1>
      <p class="py-0 text-bold"><span class="typed" data-typed-items="Di Sistem Informasi Perpustakaan, {{empty($perpus->nama_perpus)?'none':$perpus->nama_perpus}},Berbasis Website"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about py-4">
      <div class="container">
        
        <div class="section-title my-0 py-2">
          <h2 class="my-0 py-0">Daftar Buku</h2>
        </div>

        <div class="row my-0 py-0">
          <div class="col-12 my-0 py-0" data-aos="fade-right">
                
                  <table id="example2" class="table table-sm table-bordered table-striped bg-light" style="text-transform: capitalize;font-size: 10pt">
                    <thead class="bg-dark text-light">
                    <tr>
                      <th>No</th>
                      <th nowrap>Kd Buku</th>
                      <th>Judul Buku</th>
                      <th>Pengarang</th>
                      <th>Penerbit</th>
                      <th>Tahun</th>
                      <th>Jenis B.</th>
                      <th>Lok. Rak</th>
                      <th>Stok</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($buku as $buku)
                    <tr>
                        
                        <td align="center">{{$loop->iteration}}</td>
                        <td align="center"><b>{{$buku->kd_buku}}</b></td>
                        <td nowrap>{{$buku->judul_buku}}</td>
                        <td nowrap>{{$buku->pengarang}}</td>
                        <td nowrap>{{$buku->penerbit}}</td>
                        <td >{{$buku->tahun}}</td>
                        <td >{{$buku->jenis_buku}}</td>
                        <td align="center">{{$buku->lokasi_rak}}</td>
                        <td align="center">{{$buku->stok}}</td>
                            
                        
                      
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
          </div>
        </div>
          
        <br>
        <br>
        <br>

      </div>
    </section><!-- End About Section -->

   
    
  </main><!-- End #main -->

 

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>