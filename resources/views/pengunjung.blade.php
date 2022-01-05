
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
  <link href="{{ url('assets/img/apple-touch-icon.png', []) }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', []) }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css', []) }}">
  <!-- Vendor CSS Files -->
  <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css', []) }}" rel="stylesheet">
  <link href="{{ url('assets/vendor/icofont/icofont.min.css', []) }}" rel="stylesheet">
  <link href="{{ url('assets/vendor/boxicons/css/boxicons.min.css', []) }}" rel="stylesheet">
  <link href="{{ url('assets/vendor/venobox/venobox.css', []) }}" rel="stylesheet">
  <link href="{{ url('assets/vendor/owl.carousel/assets/owl.carousel.min.css', []) }}" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css', []) }}">
  <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css', []) }}">
  <link href="{{ url('assets/vendor/aos/aos.css', []) }}" rel="stylesheet">
  <link href="{{ url('assets/cssku.css', []) }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('assets/css/style.css', []) }}" rel="stylesheet">
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
              
            @if ($perangkat > 0)
            @php
                $cekPerangkat = $_SERVER['HTTP_USER_AGENT'];
                $ambil1 = explode(')', $cekPerangkat);
                $cekPerangkat = $ambil1[0];

                $ambil = DB::table('perangkat')->first();
                
            @endphp
            @if ($ambil->perangkat == $cekPerangkat)
            <li class="active"><a href="{{ route('halaman.pengunjung') }}"><i class="bx bx-edit"></i> <span>Daftar Pengunjung</span></a></li>
            @endif
              
            @else 
            <li class="active"><a href="{{ route('halaman.pengunjung') }}"><i class="bx bx-edit"></i> <span>Daftar Pengunjung</span></a></li>
            @endif

        </ul>
      </nav><!-- .nav-menu -->
      

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  {{-- style="background: url('gambar/{{$logo->logo}}'); " --}}
  <section class="d-flex flex-column justify-content-center py-2 align-items-center" style="background:url('gambar/background.jpg');filter: brightness(87%) " >
    <div class="hero-container cssku"  data-aos="fade-in">
      <h1 class="my-0 py-0 text-success" style="color: rgb(29, 199, 29) !important"><b>DAFTAR PENGUNJUNG</b></h1>
      <p class="py-0 text-bold"><span class="typed" data-typed-items="Di Sistem Informasi Perpustakaan, {{empty($perpus->nama_perpus)?'none':$perpus->nama_perpus}},Berbasis Website"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about py-4">
      <div class="container">
        
        

        <div class="row justify-content-center">
          <div class="col-md-8 p-5 pengunjung-tampilan text-center fooSelect">
            @if ($perangkat > 0)
                @php
                    
                    $cekPerangkat = $_SERVER['HTTP_USER_AGENT'];
                    $ambil1 = explode(')', $cekPerangkat);
                    $cekPerangkat = $ambil1[0];

                    $ambil = DB::table('perangkat')->first();
                    
                @endphp
                @if ($ambil->perangkat == $cekPerangkat)
                    <form action="{{ route('tambah.pengunjung') }}" method="post">
                        @csrf
                        <label for="pengunjung" class="text-secondary">Cari data menggunakan NIS/NAMA</label>
                        <select id="pengunjung" class="form-control select2" name="pengunjung" style="width: 100%" >
                            <option value=""></option>
                                @foreach ($anggota as $anggota)
                                    <option value="{{$anggota->nis}}" style="text-transform: capitalize" @if (old("anggota")==$anggota->nis)
                                        selected
                                    @endif>  {{$anggota->nis}} - {{strtoupper($anggota->namaAnggota)}} - {{strtoupper($anggota->jurusan)}}</option>
                                @endforeach
                            </select>
        
                            <div class="text-right my-3">
                            <button type="submit" class="btn btn-success">Tambah Pengunjung</button>
                        </div>
                    </form>
                
                @else
                    <script>
                        window.location = "{{ url('welcome') }}";
                    </script>
                @endif
            @else 

                <form action="{{ route('tambah.perangkat',) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary"> Aktifkan Perangkat ini untuk Tambah Pengunjung </button>
                </form>
                   
            @endif
            
              
            
          </div>
        </div>   
          
        <br>
        <br>
        <br>

      </div>
    </section><!-- End About Section -->


    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('assets/vendor/jquery/jquery.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/jquery.easing/jquery.easing.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/php-email-form/validate.js', []) }}"></script>
  <script src="{{ url('assets/vendor/waypoints/jquery.waypoints.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/counterup/counterup.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/isotope-layout/isotope.pkgd.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/venobox/venobox.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/owl.carousel/owl.carousel.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/typed.js/typed.min.js', []) }}"></script>
  <script src="{{ url('assets/vendor/aos/aos.js', []) }}"></script>
  <!-- Select2 -->
<script src="{{ url('plugins/select2/js/select2.full.min.js', []) }}"></script>

  
  <!-- Template Main JS File -->
  <script src="{{ url('assets/js/main.js', []) }}"></script>
  @include('sweetalert::alert')
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
        placeholder: "Masukan Data Anda",
        selectOnClose: true
      })
    //   $("#pengunjung").select2({ dropdownCssClass: "myFont" });
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      
  
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
  
    })

    
  </script>
</body>

</html>