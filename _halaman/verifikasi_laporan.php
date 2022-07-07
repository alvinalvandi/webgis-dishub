<?php if ($session->get('level')=='Petugas'){ ?>
<?php
  $title="Daftar Laporan Warga";
  $judul=$title;
  $fileJs='templateJs';
  $url='verifikasi_laporan';
  $id_verifikasi="";
  if (isset($_GET['id'])) {
	$id_laporan=$_GET['id'];
  }
  $petugas_verifikasi="";
  $keterangan_verifikasi="";
  date_default_timezone_set('Asia/Jakarta');
  $tanggal_verifikasi= date("Y-m-d H:i:s");


  if(isset($_GET['hapus'])){
	$setTemplate=false;
	 // hapus file di dalam folder
	 $db->where('id_laporan',$_GET['id']);
	 $get=$db->ObjectBuilder()->getOne('daftar_laporan');
	 $gambar=$get->gambar;
	 unlink('assets/unggah/gambar/'.$gambar);
	 // end hapus file di dalam folder
	
	$db->where('id_laporan',$_GET['id']);
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

  if(isset($_POST['validasi'])){
	$setTemplate=false;
	$img=upload('foto_sebelum_perbaikan','foto_sebelum_perbaikan');

		$db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$datass['kevalidan']="Valid";
		$datas['id_status']=6;
		$datass['id_status']=6;

		$get1=$db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$exec=$db->update("daftar_laporan",$datass);

		$lampu=$get1->id_lampu;
		$db->ObjectBuilder()->get('daftar_lampu');
		$db->where('id_lampu',$lampu);
		
		$exec2=$db->update("daftar_lampu",$datas);

        $db->get('verifikasi_laporan');
		if($_POST['id_verifikasi']==""){
            $db->where('id_verifikasi',$_POST['id_verifikasi']);
            $db->get('verifikasi_laporan');
			$data['id_laporan']=$_POST['id_laporan'];
            $data['petugas_verifikasi']=htmlspecialchars($_POST['petugas_verifikasi']);
            $data['keterangan_verifikasi']=htmlspecialchars($_POST['keterangan_verifikasi']);
            $data['foto_sebelum_perbaikan']=$img; 
            $data['tanggal_verifikasi']=$_POST['tanggal_verifikasi'];
           
            $db->insert("verifikasi_laporan",$data);
        }

		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Telah divalidasi</div>';

	if($exec && $exec2){
		$session->set('info',$info);
	}
	else{
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Proses gagal dilakukan
              </div>');
	}
	redirect(url($url));

} elseif(isset($_POST['tidakvalid'])){
	$setTemplate=false;
	$img=upload('foto_sebelum_perbaikan','foto_sebelum_perbaikan');

		$db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$datass['kevalidan']="Tidak Valid";
		$datas['id_status']=1;
		$datass['id_status']=1;

		$get1=$db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$exec4=$db->update("daftar_laporan",$datass);

		$lampu=$get1->id_lampu;
		$db->ObjectBuilder()->get('daftar_lampu');
		$db->where('id_lampu',$lampu);
		
		$exec5=$db->update("daftar_lampu",$datas);

        $db->get('verifikasi_laporan');
		if($_POST['id_verifikasi']==""){
            $db->where('id_verifikasi',$_POST['id_verifikasi']);
            $db->get('verifikasi_laporan');
			$data['id_laporan']=$_POST['id_laporan'];
            $data['petugas_verifikasi']=htmlspecialchars($_POST['petugas_verifikasi']);
            $data['keterangan_verifikasi']=htmlspecialchars($_POST['keterangan_verifikasi']);
            $data['foto_sebelum_perbaikan']=$img; 
            $data['tanggal_verifikasi']=$_POST['tanggal_verifikasi'];
           
            $db->insert("verifikasi_laporan",$data);
        }

		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Laporan Berhasil Diverifikasi Tidak Valid</div>';

	if($exec4 && $exec5){
		$session->set('info',$info);
	}
	else{
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4> Proses gagal dilakukan
              </div>');
	}
	redirect(url($url));
} elseif(isset($_GET['pelapor']) AND isset($_GET['id'])) {
	

?>
<div>
<button style="margin-left:1px" onclick="window.location='?halaman=verifikasi_laporan'" class="btn btn-info">Kembali</button>
</div>
<?=content_open('Halaman Cek Lokasi Pelapor')?>

<div id="mapid"></div>
<?=content_close()?>

<?php  } elseif(isset($_GET['rute']) AND isset($_GET['id'])) { 
?>
<div>
<button style="margin-left:1px" onclick="window.location='?halaman=verifikasi_laporan'" class="btn btn-info">Kembali</button>
</div>
<?=content_open('Halaman Rute Lokasi')?>

<div id="mapid"></div>
<?=content_close()?>

<?php } elseif(isset($_GET['verifikasi']) AND isset($_GET['id'])) { 
?>

<?=content_open('Form Verifikasi Petugas')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_verifikasi',$id_verifikasi)?>
    	<?=input_hidden('id_laporan',$id_laporan)?>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-3"><label>Nama Petugas</label> 
	    			<?=input_text('petugas_verifikasi',$petugas_verifikasi)?>
	    		</div>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="row">
	    	<div class="col-md-3"><label>Keterangan Verifikasi</label> 
	    			<?=textarea('keterangan_verifikasi',$keterangan_verifikasi)?>
	    		</div>
    		</div>
    	</div>
    		<div class="form-group">
    		<label>Foto Kerusakan Lampu</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('foto_sebelum_perbaikan','')?>
					<script>    
             var uploadFile = document.getElementById("file");
             var ekstensiFile = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             uploadFile.onchange = function() {
            if(this.files[0].size > 6000000){ // ukuran file 6 mb, 1000000 untuk 1 MB.
              alert("Maaf. Ukuran Foto atau Gambar Terlalu Besar ! Maksimal Ukuran 6 MB");
              this.value = "";
            };
            var pathFile = uploadFile.value;
            if(!ekstensiFile.exec(pathFile)){ // cek ekstensi file
                alert("Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.gif !");
                this.value = "";
            };
          };
          </script>
    			</div>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_date('tanggal_verifikasi',$tanggal_verifikasi)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="validasi" class="btn btn-success"><i class="fa fa-save"></i> Validasi</button>
    		<button type="submit" name="tidakvalid" class="btn btn-warning"><i class="fa fa-warning"></i> Tidak Valid</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Batal</a>
    	</div>
    </form>
<?=content_close()?>

<?php } else { ?>

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
			<th>Tanggal Laporan Masuk</th>
			<th>Status Laporan</th>
			<th>Status Lampu</th>
			<th>Gambar</th>
            <th>Verifikasi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$kevalidan = "Belum Validasi";
			$id_status =1;
			$no=1;
			$db->join('status_lampu c','c.id_status=1','LEFT');
			$db->join('daftar_lampu b','a.id_lampu=b.id_lampu','LEFT');
			$db->where('a.id_status', $id_status);
			$db->where('a.kevalidan', $kevalidan);	
			$getdata=$db->ObjectBuilder()->get('daftar_laporan a');
			// SELECT * FROM daftar_laporan a 
			// LEFT JOIN status_lampu c ON c.id_status = 1
			// LEFT JOIN daftar_lampu b ON a.id_lampu=b.id_lampu
			// WHERE a.id_status = 1 AND a.kevalidan = "Belum Validasi";
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
						<td><?=$row->nama_status?></td>
						<td class="text-center"><a class="fancybox-effects-c" href="<?=assets('unggah/gambar/'.$row->gambar);?>" title="<?=$row->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/gambar/'.$row->gambar).'" width="80px">')?></a></td>
                        <td>
						<a style="width:100%;" href="<?=url($url.'&pelapor&id='.$row->id_laporan.'&lat='.$row->lat.'&lng='.$row->lng)?>" class="btn btn-warning"><i class="fa fa-map-marker"></i> Lokasi Pelapor</a>
                        <a style="width:100%;" href="<?=url($url.'&rute&id='.$row->id_laporan.'&latitude='.$row->latitude.'&longitude='.$row->longitude.'&lat='.$row->lat.'&lng='.$row->lng)?>" class="btn btn-primary"><i class="fa fa-road"></i> Rute Lampu</a>
                        </td>
						<td>
							<a style="width:100%;" href="<?=url($url.'&verifikasi&id='.$row->id_laporan)?>" class="btn btn-success"><i class="fa fa-check"></i> Verifikasi</a>
							<a style="width:100%;" href="<?=url($url.'&hapus&id='.$row->id_laporan)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
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