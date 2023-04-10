<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Data Buku</title>
  
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

            @if ($ket == 'keseluruhan')
                cetak {{$ket}}
            @else
                cetak berdasarkan 
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

    <table style="width: 100%;font-family: Arial, Helvetica, sans-serif;text-transform: capitalize;text-align: left;border-collapse: collapse;font-size: 10pt" border="1">
      <tr>
        <th>No</th>
        <th nowrap>Kd Buku</th>
        <th nowrap>Judul Buku</th>
        <th nowrap>Pengarang</th>
        <th nowrap>Jml Buku</th>
        <th nowrap>Penerbit</th>
        <th nowrap>Tahun</th>
        <th nowrap>Lokasi Rak</th>
      </tr>
	@php
		$total = 0;
		@endphp
      @foreach ($tampil as $buku)
      @php
			$total = $total + $buku->stok;
		@endphp
      <tr valign="top">
        <td align="center">{{$loop->iteration}}</td>
        <td align="center">{{$buku->kd_buku}}</td>
        <td >{{$buku->judul_buku}}</td>
        <td >{{$buku->pengarang}}</td>
        <td align="center">{{$buku->stok}}</td>
        <td >{{$buku->penerbit}}</td>
        <td align="center">{{$buku->tahun}}</td>
        <td align="center">{{$buku->lokasi_rak}}</td>
        
      </tr>
      @endforeach
    </table>
	
	<table>
		<tr>
			<td><h3>TOTAL BUKU</h3></td>
			<td><h3>:</h3></td>
			<td><h3>{{$total}}</h3></td>
		</tr>
	</table>

</body>
</html>