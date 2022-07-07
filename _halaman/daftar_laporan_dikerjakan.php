<?php if ($session->get('level')=='Admin'){ ?>
<?php
  $title="Daftar Laporan Sedang Dikerjakan";
  $judul=$title;
  $url='daftar_laporan_dikerjakan';

?>

<?=content_open('Data Laporan Petugas')?>
<?=$session->pull("info")?>
<div style="overflow-x:auto" class="table-responsive-lg">
<table id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
		<tr>
			<th>No</th>
			<th>Nama Pelapor</th>
			<th>NIK/NISN</th>
			<th>No HP</th>
			<th>Keterangan Pelapor</th>
			<th>Lampu yang Dilapor</th>
			<th>Nama Petugas Yang Mengerjakan</th>
			<th>Keterangan Perbaikan</th>
			<th>Tanggal Perbaikan</th>
			<th>Foto Sebelum Perbaikan</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$kevalidan='valid';
			$db->join('verifikasi_laporan b','a.id_laporan=b.id_laporan','LEFT');
			$db->join('daftar_laporan d','a.id_laporan=d.id_laporan','LEFT');
			$db->join('daftar_lampu c','c.id_lampu=d.id_lampu','LEFT');
			$db->where('d.kevalidan', $kevalidan);	
			$db->where('c.id_status', 2);	
			$getdata=$db->ObjectBuilder()->get('proses_perbaikan a');
			foreach ($getdata as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->nama?></td>
						<td><?=$row->nik?></td>
						<td><?=$row->nohp?></td>
						<td><?=$row->keterangan?></td>
						<td><?=$row->alamat?></td>
						<td><?=$row->petugas_perbaikan?></td>
						<td><?=$row->keterangan_perbaikan?></td>
						<td><?=$row->tanggal_perbaikan?></td>
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