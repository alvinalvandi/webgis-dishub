<?php if ($session->get('level')=='Petugas'){ ?>
<?php
  $title="Daftar Laporan Warga";
  $judul=$title;
  $url='riwayat_perbaikan';
  $id_riwayat="";
 
  if (isset($_GET['id'])) {
	$id_laporan=$_GET['id'];
  }
  $petugas_selesai="";
  $keterangan_selesai="";
  date_default_timezone_set('Asia/Jakarta');
  $tanggal_selesai= date("Y-m-d H:i:s");

  if(isset($_POST['finish'])){
	$setTemplate=false;
    $img=upload('foto_setelah_perbaikan','foto_setelah_perbaikan');

        $db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$datas['id_status']="1";
		$datalampu['id_status']="1";

		$get1=$db->ObjectBuilder()->getOne('daftar_laporan');
		$db->where('id_laporan',$_GET['id']);
		$exec=$db->update("daftar_laporan",$datas);

		$lampu=$get1->id_lampu;
		$db->ObjectBuilder()->get('daftar_lampu');
		$db->where('id_lampu',$lampu);
		
		$exec2=$db->update("daftar_lampu",$datalampu);

        $db->get('riwayat_perbaikan');
		if($_POST['id_riwayat']==""){
            $db->where('id_riwayat',$_POST['id_riwayat']);
            $db->getOne('riwayat_perbaikan');
            $data['id_laporan']=$_POST['id_laporan'];
            $data['petugas_selesai']=htmlspecialchars($_POST['petugas_selesai']);
            $data['keterangan_selesai']=htmlspecialchars($_POST['keterangan_selesai']);
            $data['foto_setelah_perbaikan']=$img; 
            $data['tanggal_selesai']=$_POST['tanggal_selesai'];
          $db->insert("riwayat_perbaikan",$data);
        }

		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Status Lampu telah berubah!</div>';

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
}  
 elseif(isset($_GET['telahdiperbaiki']) AND isset($_GET['id'])) { 
?>

<?=content_open('Form Telah Memperbaiki Lampu')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_riwayat',$id_riwayat)?>
    	<?=input_hidden('id_laporan',$id_laporan)?>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-3"><label>Nama Petugas Yang Memperbaiki</label> 
	    			<?=input_text('petugas_selesai',$petugas_selesai)?>
	    		</div>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="row">
	    	<div class="col-md-3"><label>keterangan Telah Selesai Memperbaiki</label> 
	    			<?=textarea('keterangan_selesai',$keterangan_selesai)?>
	    		</div>
    		</div>
    	</div>
        <div class="form-group">
    		<label>Foto Setelah Diperbaiki</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('foto_setelah_perbaikan','')?>
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
                    <?=input_date('tanggal_selesai',$tanggal_selesai)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="finish" class="btn btn-info"><i class="fa fa-refresh"></i> Konfirmasi</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Batal</a>
    	</div>
    </form>

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
			<th>Status Perbaikan</th>
			<th>Gambar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$kevalidan = "Valid";
            $id_status=2;
            $no=1;
			$db->join('status_lampu c','c.id_status=2','LEFT');
			$db->join('daftar_lampu b','a.id_lampu=b.id_lampu','LEFT');
			$db->where('a.id_status', $id_status);	
			$db->where('a.kevalidan', $kevalidan);
			$getdata=$db->ObjectBuilder()->get('daftar_laporan a');
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
						<td><?php if ($row->id_status=='2') {
							echo 'Sedang Perbaikan';
						} ?></td>
						<td class="text-center "><a class="fancybox-effects-c" href="<?=assets('unggah/gambar/'.$row->gambar);?>" title="<?=$row->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/gambar/'.$row->gambar).'" width="50px">')?></a></td>
						<td>
							<a style="margin-bottom:5px" href="<?=url($url.'&telahdiperbaiki&id='.$row->id_laporan)?>" class="btn btn-success"><i class="fa fa-check-square-o"></i> Telah <br> Diperbaiki</a>
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