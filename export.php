<?php
require 'vendor/autoload.php';
require '_loader.php';

$id_laporan=$_GET['id'];
$db->join('proses_perbaikan b','b.id_laporan='.$id_laporan,'LEFT');
$db->join('daftar_laporan c','a.id_laporan=c.id_laporan','LEFT');
$db->join('daftar_lampu d','c.id_lampu=d.id_lampu','LEFT');
$db->join('verifikasi_laporan e','e.id_laporan='.$id_laporan,'LEFT');
$db->where('a.id_laporan', $id_laporan);	
$getdataz=$db->get('riwayat_perbaikan a');
  foreach ($getdataz as $row) {

$html='
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Petugas</title>
	<style> 
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	  }
	  
	  td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	  }

	  th {
		text-align: left;
	  }
	  
	  #t01 td {
		text-align: center;
	  }

	</style>

</head>
<body>	
	<h2 align="center">Laporan Petugas Lapangan</h2>
	<table id="t01" class="table table-bordered" cellpadding="10" cellspacing="1" width="100%">
    <thead>
        <tr>
        <th style="width:30%; text-align:center">Data</th>
        <th style="width:60%; text-align:center">Nilai</th>	
        </tr>
    </thead>
	<tbody>
	<tr style="background-color: #eee;">
	  <th>
		  <span>
		  Lampu Yang Dilapor
		  </span>
	  </th>
		<td>'.$row['alamat'].'</td>
  </tr>
  <tr>
  	<th>
		<span>
		Tanggal Masuk Laporan
		</span>
	</th>
	  <td>'.$row['tanggal'].'</td>
  </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
	     Nama Pelapor
   		 </span>
  	  </th>
 		 <td>'.$row['nama'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
	     NIK/NISN Pelapor
   		 </span>
  	  </th>
 		 <td>'.$row['nik'].'</td>
    </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
	     No HP Pelapor
   		 </span>
  	  </th>
 		 <td>'.$row['nohp'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
		 Keterangan
   		 </span>
  	  </th>
 		 <td>'.$row['keterangan'].'</td>
    </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
			Diverifikasi Oleh
   		 </span>
  	  </th>
 		 <td>'.$row['petugas_verifikasi'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
			Tanggal Verifikasi
   		 </span>
  	  </th>
 		 <td>'.$row['tanggal_verifikasi'].'</td>
    </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
			Keterangan Verifikasi
   		 </span>
  	  </th>
 		 <td>'.$row['keterangan_verifikasi'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
			Foto Verifikasi
   		 </span>
  	  </th>
		<td><img src="assets/unggah/foto_sebelum_perbaikan/'.$row['foto_sebelum_perbaikan'] .'" width="160px"></a>
	</tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
			Diperbaiki Oleh
   		 </span>
  	  </th>
 		 <td>'.$row['petugas_perbaikan'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
			Tanggal Perbaikan
   		 <span>
  	  </th>
 		 <td>'.$row['tanggal_perbaikan'].'</td>
    </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
			Keterangan Perbaikan
   		 </span>
  	  </th>
 		 <td>'.$row['keterangan_perbaikan'].'</td>
    </tr>
	<tr>
      <th>
   		 <span>
			Konfirmasi Perbaikan Oleh
   		 </span>
  	  </th>
 		 <td>'.$row['petugas_selesai'].'</td>
    </tr>
	<tr style="background-color: #eee;">
	  <th>
			<span>
			Tanggal Konfirmasi
			</span>
		</th>
		  <td>.'.$row['tanggal_selesai'].'</td>
	</tr>			
	<tr>
      <th>
   		 <span>
			Keterangan Konfirmasi
   		 </span>
  	  </th>
 		 <td>'.$row['keterangan_selesai'].'</td>
    </tr>
	<tr style="background-color: #eee;">
      <th>
   		 <span>
			Foto Setelah Perbaikan
   		 </span>
  	  </th>
        <td><img src="assets/unggah/foto_setelah_perbaikan/'.$row['foto_setelah_perbaikan'] .'" width="160px"></a>				
    </tr>
	</tbody>
</table>
</body>
</html>';

}

use Dompdf\Dompdf;

$dompdf= new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4','portrait');

$dompdf->render();

$dompdf->stream("laporan-petugas", array("Attachment" => 0));
?>