<?php if ($session->get('level')=='Admin'){ ?>
<?php
  $title="Riwayat Perbaikan";
  $judul=$title;
  $url='daftar_laporan_valid';
 
	if(isset($_GET['hapusdata'])){
		$setTemplate=false;
		
		//tabel riwayat perbaikan
		$db->where('id_laporan',$_GET['id']);
		$get3=$db->ObjectBuilder()->getOne('riwayat_perbaikan');
		$foto2=$get3->foto_setelah_perbaikan;
		unlink('assets/unggah/foto_setelah_perbaikan/'.$foto2);
		$db->where('id_laporan',$_GET['id']);
		$db->delete("riwayat_perbaikan");

		//tabel verifikasi laporan
		$db->where('id_laporan',$_GET['id']);
		$get1=$db->ObjectBuilder()->getOne('verifikasi_laporan');
		$foto=$get1->foto_sebelum_perbaikan;
		unlink('assets/unggah/foto_sebelum_perbaikan/'.$foto);
		$db->where('id_laporan',$_GET['id']);
		$db->delete("verifikasi_laporan");

		//tabel proses perbaikan 
		$db->where('id_laporan',$_GET['id']);
		$get2=$db->ObjectBuilder()->getOne('proses_perbaikan');
		$db->where('id_laporan',$_GET['id']);
		$db->delete("proses_perbaikan");

		//tabel daftar laporan
	   $db->where('id_laporan',$_GET['id']);
	   $get4=$db->ObjectBuilder()->getOne('daftar_laporan');
	   $gambar=$get4->gambar;
	   unlink('assets/unggah/gambar/'.$gambar);
	   $db->where("id_laporan",$_GET['id']);
	  $exec=$db->delete("daftar_laporan");
		
	
		$info='<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses dihapus </div>';
		if($exec){
			$session->set('info',$info);
		}
		else{
		  $session->set("info",'<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4> Proses gagal dilakukan
				  </div>');
		}
		redirect(url($url));
	}
?>

<?php if (isset($_GET['detail']) AND isset($_GET['id'])) { 
				
			$id_laporan=$_GET['id'];
			$db->join('proses_perbaikan b','b.id_laporan='.$id_laporan,'LEFT');
			$db->join('daftar_laporan c','a.id_laporan=c.id_laporan','LEFT');
			$db->join('daftar_lampu d','c.id_lampu=d.id_lampu','LEFT');
			$db->join('verifikasi_laporan e','e.id_laporan='.$id_laporan,'LEFT');
			$db->where('a.id_laporan', $id_laporan);	
			$getdata=$db->ObjectBuilder()->get('riwayat_perbaikan a');
			  foreach ($getdata as $row) {
				?>

<?=content_open('Data Laporan Petugas')?>
<?=$session->pull("info")?>
<div class="table-responsive-lg">

<table class="table table-striped">
	<thead>
		<tr>
		<th style="width:20%"></th>
        <th style="width:50%"></th>	
		</tr>
	</thead>
	<tbody>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Lampu Yang Dilapor
   		 </span>
  	  </th>
 		 <td><?=$row->alamat?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Tanggal Masuk Laporan
   		 </span>
  	  </th>
 		 <td><?=$row->tanggal?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
	     Nama Pelapor
   		 </span>
  	  </th>
 		 <td><?=$row->nama?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
	     NIK/NISN Pelapor
   		 </span>
  	  </th>
 		 <td><?=$row->nik?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
	     No HP Pelapor
   		 </span>
  	  </th>
 		 <td><?=$row->nohp?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
		 Keterangan
   		 </span>
  	  </th>
 		 <td><?=$row->keterangan?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Diverifikasi Oleh
   		 </span>
  	  </th>
 		 <td><?=$row->petugas_verifikasi?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Tanggal Verifikasi
   		 </span>
  	  </th>
 		 <td><?=$row->tanggal_verifikasi?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Keterangan Verifikasi
   		 </span>
  	  </th>
 		 <td><?=$row->keterangan_verifikasi?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Foto Verifikasi
   		 </span>
  	  </th>
		<td><a class="fancybox-effects-c" href="<?=assets('unggah/foto_sebelum_perbaikan/'.$row->foto_sebelum_perbaikan);?>" 
		title="<?=$row->keterangan_verifikasi?>" alt="gambar"><?=('<img src="'.assets('unggah/foto_sebelum_perbaikan/'.$row->foto_sebelum_perbaikan).'" width="80px">')?></a>
	</tr>	
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Diperbaiki Oleh
   		 </span>
  	  </th>
 		 <td><?=$row->petugas_perbaikan?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Tanggal Perbaikan
   		 </span>
  	  </th>
 		 <td><?=$row->tanggal_perbaikan?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Keterangan Perbaikan
   		 </span>
  	  </th>
 		 <td><?=$row->keterangan_perbaikan?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Konfirmasi Perbaikan Oleh
   		 </span>
  	  </th>
 		 <td><?=$row->petugas_selesai?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Tanggal Konfirmasi
   		 </span>
  	  </th>
 		 <td><?=$row->tanggal_selesai?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Keterangan Konfirmasi
   		 </span>
  	  </th>
 		 <td><?=$row->keterangan_selesai?></td>
    </tr>
	<tr>
      <th>
   		 <span class="sparkline_line" style="height: 160px;">
			Foto Setelah Perbaikan
   		 </span>
  	  </th>
		<td><a class="fancybox-effects-c" href="<?=assets('unggah/foto_setelah_perbaikan/'.$row->foto_setelah_perbaikan);?>" 
		title="<?=$row->keterangan_selesai?>" alt="gambar"><?=('<img src="'.assets('unggah/foto_setelah_perbaikan/'.$row->foto_setelah_perbaikan).'" width="80px">')?></a>				
    </tr>		
	<a href="<?=url($url)?>" class="btn btn-primary" ><i class="fa fa-reply"></i> Kembali</a>
<a href="<?=url($url.'&hapusdata&id='.$row->id_laporan)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')">
<i class="fa fa-trash"></i> Hapus</a>
<a href="<?=export('export.php?id='.$row->id_laporan)?>" class="btn btn-success" target="_BLANK">
<i class="fa fa-file-pdf-o"></i> Export PDF</a>
	</tbody>
</table>
</div>
<?=content_close()?>
<?php } ?>

<?php } else { ?>
<?=content_open('Data Laporan Petugas')?>
<?=$session->pull("info")?>
<div class="table-responsive-lg">

<table id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
		<tr>
			<th>No</th>
			<th>Nama Petugas</th>
			<th>Keterangan</th>
			<th>Tanggal Selesai Diperbaiki</th>
			<th>Foto Setelah Perbaikan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			  $no=1;
			  $db->join('proses_perbaikan b','a.id_laporan=b.id_laporan','LEFT');
			  $db->join('daftar_laporan c','a.id_laporan=c.id_laporan','LEFT');
			  $getdatas=$db->ObjectBuilder()->get('riwayat_perbaikan a');
			foreach ($getdatas as $rows) {
				?>
					<tr>
					<td><?=$no?></td>
						<td><?=$rows->petugas_selesai?></td>
						<td><?=$rows->keterangan_selesai?></td>
						<td><?=$rows->tanggal_selesai?></td>
						<td class="text-center"><a class="fancybox-effects-c" href="<?=assets('unggah/foto_setelah_perbaikan/'.$rows->foto_setelah_perbaikan);?>" title="<?=$rows->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/foto_setelah_perbaikan/'.$rows->foto_setelah_perbaikan).'" width="80px">')?></a></td>
						<td>
						<a href="<?=url($url.'&detail&id='.$rows->id_laporan)?>" class="btn btn-info">
							<i class="fa fa-bars"></i> Detail</a>
						<a href="<?=url($url.'&hapusdata&id='.$rows->id_laporan)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')">
							<i class="fa fa-trash"></i> Hapus</a>
						</td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
</div>
<?=content_close()?>
<?php } ?>
<?php } else {
	redirect(url('beranda'));
}
	?>