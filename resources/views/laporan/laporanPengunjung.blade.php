<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Anggota</title>
  
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
  @php
      $tanggal = date('d');
      $bulan_belum_jadi = date('m');
      $bulan = ltrim($bulan_belum_jadi,'0');
      $tahun = date('Y');
      $nama_bulan = ['Bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  @endphp
  
      <table style="width: 100%;">
        <tr>
          <td>
            <div class="font" style="font-size: 13pt;font-weight: bold;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;text-transform: capitalize">
              <br>
              Laporan {{$laporan}}
  
            </div>
            <div class="font" style="font-size: 10;text-transform: capitalize;">
  
              @if ($ket == 'keseluruhan')
                  Cetak {{$ket}} peminjaman satuan 
              @else
                  Cetak peminjaman berdasarkan 
                  <?php 
                      $S = substr_count($ket, "-");
                      $ket2 = explode("-", $ket);
                      if($S == 1){
                          echo "<b>".$nama_bulan[ltrim($ket2[1],"0")]." ".$ket2[0]."</b>";
                      
                      }else if ($S == 2) {
                          echo "<b>".$ket2[2]." ".$nama_bulan[ltrim($ket2[1],"0")]." ".$ket2[0]."</b>";
                      }else {
                          echo "<b>".$ket."</b>";
                      }
                  ?>
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
  
              echo hari_ini().', '.$tanggal.' '.$nama_bulan[$bulan].' '.$tahun;
              
              
              ?>
          </td>
        </tr>
      </table>

    <table style="width: 100%;font-family: Arial, Helvetica, sans-serif;text-transform: capitalize;text-align: left;border-collapse: collapse;font-size: 10pt" border="1">
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Anggota</th>
        <th>Jurusan</th>
        <th>Bulan</th>
      </tr>
      @foreach ($tampil as $anggota)
          
      <tr>
        <td align="center">{{$loop->iteration}}</td>
        <td align="center">{{$anggota->nis}}</td>
        <td nowrap>{{$anggota->namaAnggota}}</td>
        <td align="center" style="text-transform: uppercase;">{{$anggota->jurusan}}</td>
        <td align="center">
          {{ date("d F Y", strtotime($anggota->created_at)) }}
        </td>
      </tr>
      @endforeach
    </table>

</body>
</html>