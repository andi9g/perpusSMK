@php
    $logo_perpus = DB::table('tb_logo')->first();
    if(Session::get('status')=='admin'){
      $profile = DB::table('tb_admin')->where('id',Session::get('id'))->first();
    }else if(Session::get('status')=='anggota'){
      $profile = DB::table('tb_anggota')->where('id',Session::get('id'))->first();
    }
    $foto = empty($profile->foto)?'avatar.png':$profile->foto;
    $logoo = empty($logo_perpus->logo)?'':$logo_perpus->logo;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css', []) }}">
  <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css', []) }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css', []) }}">

   
   <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('font-awesome/css/font-awesome.min.css', []) }}">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css', []) }}">
  <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css', []) }}">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css', []) }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css', []) }}">
  <link rel="stylesheet" href="{{ url('styleku.css?v=378', []) }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ url('dist/css/googleapis.css?v=280', []) }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed " >
  @php
  $dblogo = DB::table('tb_logo')->first();
  $dbPengaturan = DB::table('tb_pengaturan')->first();
@endphp
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            @if (Session::get('status')=="admin")
              <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/pengaturan', []) }}" class="nav-link @yield('activePengaturan')"><i class="fa fa-gears fa-lg"></i></a>
              </li>                
            @endif
           

        </ul>

        <!-- SEARCH FORM -->
        <div class="form-inline ml-3" >
            <div class="input-group input-group-sm">
                <input
                    style="font-weight: bold;"
                    class="form-control form-control-navbar text-center text-white"
                    type="text"
                    value="{{ucwords(Session::get('nama_pengguna'))}}"
                    aria-label="Search"
                    disabled="disabled">
                </div>
                
              </div>
              

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto" >
                <!-- Messages Dropdown Menu -->

                <li class="nav-item dropdown " >
                  <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-lg fa-user-circle text-bold" style="font-size: 23px"></i>
                    <span></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-ku" >
                    
                    <div class="row">
                      <div class="col text-center py-3">
                        <img src="{{ url('gambar/profile/'.$foto, []) }}" class="rounded-circle mb-2" style="border:2px solid;" width="80px" height="80px" alt="">
                        <h5 style="text-transform: capitalize">{{Session::get('nama_pengguna')}}</h5>
                      </div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="{{ url('profile', []) }}" class="dropdown-item hoverku2">
                      <i class="fas fa-user mr-2"></i> Pofil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('profile', []) }}" class="dropdown-item hoverku2">
                      <i class="fas fa-key mr-2"></i> Ubah password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/keluar', []) }}" class="dropdown-item hoverku2">
                      <i class="fas fa-power-off mr-2"></i> Keluar
                    </a>
                    
                  </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
    

    <aside class="main-sidebar sidebar-primary elevation-4 bg-success">
        <!-- Brand Logo -->
        
        <a href="{{ url('/', []) }}" class="brand-link text-dark ">
          <img src="{{ url('gambar/'.$logoo) }}" alt="AdminLTE Logo" class="brand-image "
               style="opacity: 1">
          <span class="brand-text font-weight-light judul"><b>Aplikasi Perpustakaan</b></span>
        </a>
    
    
       
        <!-- Sidebar -->
        <div class="sidebar sidebarku" >
          <nav class="mt-2 mr-2 pr-1">
            <ul class="nav nav-flat nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-header"><b>MENU APLIKASI</b><hr class="m-0 p-0"></li>   
              @if (Session::get('status')=='anggota')
                  <li class="nav-item hoverku @yield('activeDashboard')">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-item hoverku @yield('activeDataPinjaman')">
                    <a href="{{ url('/pinjaman') }}" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Data Peminjaman
                      </p>
                    </a>
                  </li>
                  <li class="nav-item hoverku @yield('activeDataKembali')">
                    <a href="{{ url('/kembali') }}" class="nav-link">
                      <i class="nav-icon fas fa-check"></i>
                      <p>
                        Data Pengembalian
                      </p>
                    </a>
                  </li>
              @endif
              @if (Session::get('status')=='admin')
                  <li class="nav-item hoverku @yield('activeHome')" id="home">
                    <a href="{{ url('/') }}" class="nav-link">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Home
                      </p>
                    </a>
                  </li>

                  <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link @yield('activeDataPerpus')">
                      <i class="nav-icon fas fa-th"></i>
                      <p>
                        Data Perpus
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item ">
                        <a href="{{ url('anggota') }}" class="nav-link @yield('activeDataAnggota')">
                          <i class="fa fa-users nav-icon"></i>
                          <p>Data Anggota</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('buku', []) }}" class="nav-link @yield('activeDataBuku')">
                          <i class="fas fa-book nav-icon"></i>
                          <p>Data Buku</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ url('admin', []) }}" class="nav-link @yield('activeDataAdmin')">
                          <i class="fas fa-user-secret nav-icon"></i>
                          <p>Data Admin</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-header"><b>PROSES  </b><hr class="m-0 p-0"></li> 
                  <li class="nav-item hoverku @yield('activeDataPeminjaman')">
                    <a href="{{ url('peminjaman', []) }}" class="nav-link">
                      <i class="nav-icon fas fa-hourglass-1"></i>
                      <p>
                        Peminjaman
                      </p>

                      @php
                          $notif = DB::table('tb_peminjaman')
                          ->join('tb_anggota','tb_anggota.nis','=','tb_peminjaman.nis')
                          ->join('tb_buku','tb_buku.kd_buku','=','tb_peminjaman.kd_buku')
                          ->where('status','pinjam')
                          ->select('tb_peminjaman.created_at','tb_peminjaman.ket')->get();

                          $keterlambatan = DB::table('tb_pengaturan')->first();
                          $masaa = $keterlambatan->keterlambatan;
                          $telat=0;
                          $bentarLagi =0;
                          foreach ($notif as $peminjaman) {
                            $tgl_pinjam = strtotime($peminjaman->created_at);

                            if($peminjaman->ket=="-"){
                              $masa_pinjam = strtotime('+'.$masaa.' days',strtotime($peminjaman->created_at));
                            }else{
                              $masa_pinjam = strtotime('+1 days',strtotime($peminjaman->created_at));
                            }
                            $tgl_sekarang = strtotime('now');

                            $total_jumlah = number_format(($tgl_sekarang - $masa_pinjam)/86400);

                            
                            if ($total_jumlah<0) {
                              $keterlambatan = $total_jumlah * -1;
                              if($keterlambatan>=3){
                              
                              }else{
                                $bentarLagi++;
                              }
                            }else if($total_jumlah==0){
                              $bentarLagi = $bentarLagi+1;
                            }else{
                              $telat++;
                            }
                          }
                      @endphp
                      @if ($bentarLagi>0 || $telat>0)
                      <div class="right badge">
                        <small class="right badge badge-warning p-1">{{$bentarLagi}}</small>
                        <small class="right badge badge-danger p-1">{{$telat}}</small>
                      </div>
                      
                        
                      
                      @else
                      @endif
                    </a>
                  </li>
                  <li class="nav-item hoverku @yield('activeDataPengembalian')">
                    <a href="{{ url('/pengembalian', []) }}" class="nav-link">
                      <i class="nav-icon fas fa-calendar-times-o"></i>
                      <p>
                        Pengembalian
                      </p>
                    </a>
                  </li>
              @endif  
              

              
              
            
              
              <li class=""><br class=""></li>
              <li class=""></li>
              <li class=""></li>        </ul>
              
          </nav>  
         
      </aside>

  <div class="content-wrapper bodyku" >
    <!-- Content Header (Page header) -->

    <div class="container-fluid m-0 p-0">
        <section class="content-header bg-namaMenu">
          <div class="container">
            <div class="row mb-1 ">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('namaMenu')</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @yield('link')
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>




        <section class="content ml-2 mr-2 mt-0">
          <div class="container mt-0">
            @yield('content')
            </div>
          </div>
        </section>
    </div>
  </div>
</div>





<footer class="main-footer ">
  <strong>Copyright &copy; 2021 <a href="#">Aplikasi Perpustakaan <i class="fa fa-heart"></i>ARBP</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>

    <!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js', []) }}"></script>
<!-- Bootstrap -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js', []) }}"></script>

<!-- Select2 -->
<script src="{{ url('plugins/select2/js/select2.full.min.js', []) }}"></script>


<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.js', []) }}"></script>


<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('plugins/chart.js/Chart.min.js', []) }}"></script>
<script src="{{ url('dist/js/demo.js', []) }}"></script>
@yield('chart')



<!-- Toastr -->

<!-- PAGE PLUGINS -->


<!-- DataTables -->
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js', []) }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js', []) }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js', []) }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js', []) }}"></script>
<!-- ChartJS -->


 
<!-- PAGE SCRIPTS -->
<script src="{{ url('dist/js/pages/dashboard2.js', []) }}"></script>
@include('sweetalert::alert')
<!-- OPTIONAL SCRIPTS -->



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @yield('myJS')
  @yield('jQueryku')

</body>
</html>