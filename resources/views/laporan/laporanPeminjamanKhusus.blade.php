<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Peminjaman</title>
  
  <link rel="stylesheet" href="cssLaporan">
</head>
<body>

    <table class="kop" style="width: 100%;font-family: Arial, Helvetica, sans-serif;padding-bottom: 2;border-bottom: 2px solid">
      <tr>
        <td style="width: 15%;" align="center">
            <img src="img/SMKN1GK.png" style="margin-right: -20px" width="70px" alt="">
        </td>

        <td style="width: 64%" align="center" valign="top">
          <div class="font" style="font-size: 16pt;font-weight: bold">

            SISTEM INFORMASI PERPUSTAKAAN

          </div>
          <div class="font" style="font-size: 16pt;font-weight: bold">

            SMK NEGERI 01 GUNUNG KIJANG

          </div>
          <p style="margin-top:0;margin-bottom: 2 ;font-size: 7.5pt;font-weight: bold">Jl. Poros Lome-Pulau Pucung, Malang Rapat, Gn.Kijang, Kabupaten Bintan, Kepulauan Riau 29151</p>

            <table style="width: 100%;font-size: 8pt;margin:0;padding: 0;border-collapse: collapse;">
              <tr>
                <td style="width: 50%;text-align: right;padding-right: 5px; border-right: 1px solid">
                   Website : www.smkn1gunungkijang.sch.id
                  
                </td>
                <td style="width: 50%;text-align: left;padding-left: 5px;">
                   Email : smkn1gunungkijang@yahoo.com
                </td>
              </tr>
              <tr>
                <td colspan="2" style="text-align: center;">
                  Telepon : 082382699442
                </td>
              </tr>
            </table>
          
        </td>


        <td style="width: 15%"></td>

      </tr>
    </table>


    <table style="width: 100%;">
      <tr>
        <td>
          <div class="font" style="font-size: 13pt;font-weight: bold;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;text-transform: capitalize">
            <br>
            Laporan {{$laporan}}

          </div>
          <div class="font" style="font-size: 10;text-transform: capitalize;">

            @if ($ket == 'peminjamanKhusus')
                Cetak Peminjaman Khusus 
            
            @endif

          </div>
        </td>
        <td valign="top" style="font-size: 10; text-align: right;font-weight: none;">
          <?php 
            function hari_ini(){
              $hari = date ("D");
            
              switch($hari){
                case 'Sun':
                  $hari_ini = "Minggu";
                break;
            
                case 'Mon':			
                  $hari_ini = "Senin";
                break;
            
                case 'Tue':
                  $hari_ini = "Selasa";
                break;
            
                case 'Wed':
                  $hari_ini = "Rabu";
                break;
            
                case 'Thu':
                  $hari_ini = "Kamis";
                break;
            
                case 'Fri':
                  $hari_ini = "Jumat";
                break;
            
                case 'Sat':
                  $hari_ini = "Sabtu";
                break;
                
                default:
                  $hari_ini = "Tidak di ketahui";		
                break;
              }
            
              return $hari_ini;
            
            }
            $tanggal = date('d');
            $bulan_belum_jadi = date('m');
            $bulan = ltrim($bulan_belum_jadi,'0');
            $tahun = date('Y');
            $nama_bulan = ['Bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

            echo hari_ini().', '.$tanggal.' '.$nama_bulan[$bulan].' '.$tahun;
            
            
            ?>
        </td>
      </tr>
    </table>

    <table style="width: 100%;font-family: Arial, Helvetica, sans-serif;text-transform: capitalize;text-align: left;border-collapse: collapse;font-size: 9pt" border="1">
      <tr>
        <th>No</th>
        <th nowrap>Nis</th>
        <th nowrap>Nama</th>
        <th nowrap>kd. Buku</th>
        <th nowrap>Judul</th>
        <th nowrap>Tgl Pinjam</th>
        <th nowrap>Jml</th>
        <th nowrap>Ket</th>
      </tr>
      @foreach ($tampil as $pinjam)
          
      <tr>
        <td align="center">{{$loop->iteration}}</td>
        <td align="center">{{$pinjam->nis}}</td>
        <td nowrap>{{$pinjam->namaAnggota}}</td>
        <td align="center">{{$pinjam->kd_buku}}</td>
        <td nowrap>{{$pinjam->judul_buku}}</td>
        <td align="center">{{date('d/m/Y', strtotime($pinjam->created_at))}}</td>
        <td align="center">{{$pinjam->jumlah_pinjam}}</td>
        <td align="center">{{$pinjam->ket}}</td>
      </tr>
      @endforeach
    </table>

</body>
</html>