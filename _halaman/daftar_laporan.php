<?php if ($session->get('level')=='Admin'){ ?>
<?php
  $title="Daftar Laporan Petugas";
  $judul=$title;
  $url='daftar_laporan';

?>

<?=content_open('Data Laporan Petugas')?>
<?=$session->pull("info")?>
<div style="overflow-x:auto" class="table-responsive-lg">
<table id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
	
		<tr>
			<th>No</th>
			<th>Nama Petugas yang memverifikasi</th>
			<th>Nama Pelapor</th>
			<th>NIK/NISN</th>
			<th>No HP</th>
			<th>Lokasi Lampu Yang Dilapor</th>
			<th>Keterangan Verifikasi</th>
			<th>Tanggal Diverifikasi</th>
			<th>Status Laporan</th>
			<th>Foto Verifikasi</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			$kevalidan='valid';
			$no=1;
			$db->join('verifikasi_laporan b','a.id_laporan=b.id_laporan','LEFT');
			$db->join('daftar_lampu c','c.id_lampu=a.id_lampu','LEFT');
			$db->where('a.kevalidan', $kevalidan);	
			$getdata=$db->ObjectBuilder()->get('daftar_laporan a');
			foreach ($getdata as $row) {
				?>
				
					<tr>
						<td><?=$no?></td>
						<td><?=$row->petugas_verifikasi?></td>
						<td><?=$row->nama?></td>
						<td><?=$row->nik?></td>
						<td><?=$row->nohp?></td>
						<td><?=$row->alamat?></td>
						<td><?=$row->keterangan?></td>
						<td><?=$row->tanggal_verifikasi?></td>
						<td><?=$row->kevalidan?></td>
						<td class="text-center"><a class="fancybox-effects-c" href="<?=assets('unggah/foto_sebelum_perbaikan/'.$row->foto_sebelum_perbaikan);?>" title="<?=$row->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/foto_sebelum_perbaikan/'.$row->foto_sebelum_perbaikan).'" width="80px">')?></a></td>
					</tr>
				<?php
				$no++;
			}

		?>
	</tbody>
</table>
</div>
<?=content_close()?>
<?php } else {
	redirect(url('beranda'));
}
	?>