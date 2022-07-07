<?php if ($session->get('level')=='Petugas'){ ?>
<?php
  $title="Riwayat Laporan";
  $judul=$title;
  $url='riwayat_laporan';

if(isset($_GET['hapus'])){
	$setTemplate=false;
		
	$db->where('id_laporan',$_GET['id']);
	$get6=$db->ObjectBuilder()->getOne('verifikasi_laporan');
	$foto6=$get6->foto_sebelum_perbaikan;
	unlink('assets/unggah/foto_sebelum_perbaikan/'.$foto6);
	$db->where("id_laporan",$_GET['id']);
	$db->delete("verifikasi_laporan");

		// hapus file di dalam folder
		   //tabel daftar_laporan
		$db->where('id_laporan',$_GET['id']);
		$get=$db->ObjectBuilder()->getOne('daftar_laporan');
		$gambar=$get->gambar;
		unlink('assets/unggah/gambar/'.$gambar);
		// end hapus file di dalam folder
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

<?=content_open('Data Laporan Warga')?>
<?=$session->pull("info")?>
<div style="overflow-x:auto" class="table-responsive-lg">
<table id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>NIK/NISN</th>
			<th>No HP</th>
			<th>Lokasi Lampu</th>
			<th>Keterangan</th>
			<th>Tanggal Masuk Laporan</th>
			<th>Status Laporan</th>
			<th>Status Perbaikan</th>
			<th>gambar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
            $id_status=1;
			$no=1;
			$db->join('status_lampu c','c.id_status=1','LEFT');
            $db->join('daftar_lampu b','a.id_lampu=b.id_lampu','LEFT');
			$db->where('a.kevalidan', 'Valid');
			$db->where('a.id_status', $id_status);
			$db->orWhere('a.kevalidan', 'Tidak Valid');
			$db->orderBy("kevalidan","Asc");
			$getdata=$db->ObjectBuilder()->get('daftar_laporan a', 5);
			foreach ($getdata as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->nama?></td>
						<td><?=$row->nik?></td>
						<td><?=$row->nohp?></td>
						<td><?=$row->alamat?></td>
						<td><?=$row->keterangan?></td>
						<td><?=$row->tanggal?></td>
						<td><?=$row->kevalidan?></td>
						<td><?php if ($row->kevalidan=='Tidak Valid') {
							echo 'Tidak Perlu Perbaikan';
						} else {
							echo 'Perbaikan Selesai';
						}?></td>
						<td class="text-center"><a class="fancybox-effects-c" href="<?=assets('unggah/gambar/'.$row->gambar);?>" title="<?=$row->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/gambar/'.$row->gambar).'" width="50px">')?></a></td>
						<td>
						<?php if ($row->kevalidan=='Tidak Valid') {
						?>
						<a href="<?=url($url.'&hapus&id='.$row->id_laporan)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')">
						<i class="fa fa-trash"></i> Hapus</a>
						<?php } else{ ?>
						<a href="" class="btn btn-danger" style="opacity: 0.6; cursor: not-allowed;" >
						<i class="fa fa-trash"></i> Hapus</a>
						<?php } ?>
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
<?php } else {
	redirect(url('beranda'));
}
?>