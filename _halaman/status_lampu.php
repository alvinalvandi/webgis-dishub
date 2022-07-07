<?php if ($session->get('level')=='Admin'){ ?>
<?php
  $title="Status Lampu Lalu Lintas";
  $judul=$title;
  $url='status_lampu';
if(isset($_POST['simpan'])){
	$file=upload('marker','marker');
	if($file!=false){
		$data['marker']=$file;
	}

	// cek kode agar tidak dobel
	$dobel=null;
	// cek kode apakah sudah ada
	if($_POST['id_status']!=""){
		$db->where('id_status !='.$_POST['id_status']);
	}
	$db->where('kode_status',$_POST['kode_status']);
	$db->get('status_lampu');
	if($db->count>0){
		$dobel[]='Kode status sudah tersedia harap masukkan kode status yang lain';
	}
	if(!is_numeric($_POST['kode_status'])){
		$dobel[]='Kode harus berupa angka';
	}

	$db->where('nama_status',$_POST['nama_status']);
	$db->get('status_lampu');
	if($db->count>0){
		$dobel[]='Nama status sudah tersedia harap masukkan nama status yang lain';
	}
	
	if(count($dobel)>0){
		$setTemplate=false;
		$session->set('error_info',$dobel);
		$session->set('error_value',$_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	

	$data['id_status']=$_POST['id_status'];
	$data['kode_status']=$_POST['kode_status'];
	$data['nama_status']=$_POST['nama_status'];
	if($_POST['id_status']==""){
		$exec=$db->insert("status_lampu",$data);
		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses Ditambah </div>';
		
	}
	else{
		$db->where('id_status',$_POST['id_status']);
		$exec=$db->update("status_lampu",$data);
		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses diubah </div>';
	}

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

  elseif(isset($_GET['ubah']) AND isset($_GET['id'])){
  	$id=$_GET['id'];
  	$db->where('id_status',$id);
	$row=$db->ObjectBuilder()->getOne('status_lampu');
	if($db->count>0){
		$id_status=$row->id_status;
		$kode_status=$row->kode_status;
		$nama_status=$row->nama_status;
		$marker=$row->marker;
    }
	  // value ketika validasi
	  if($session->get('error_value')){
		extract($session->pull('error_value'));
	}
  
?>
<?=content_open('Form Status Lampu Lalu Lintas')?>
   <form method="post" enctype="multipart/form-data">
   <?php
    		// menampilkan error validasi
  			if($session->get('error_info')){
  				foreach ($session->pull('error_info') as $key => $value) {
  					echo '<div class="alert alert-danger">'.$value.'</div>';
  				}
  			}
    	?>
    	<?=input_hidden('id_status',$id_status)?>
    	<div class="form-group">
    		
    		<div class="row">
	    		<div class="col-md-3"><label>Kode Status</label> 
	    			<?=input_text('kode_status',$kode_status)?>
	    		</div>
                
                <div class="col-md-3"><label>Nama Status</label> 
	    			<?=input_text('nama_status',$nama_status)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Marker</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('marker','')?>
					<script>    
             var uploadFile = document.getElementById("file");
             var ekstensiFile = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             uploadFile.onchange = function() {
            if(this.files[0].size > 6000000){ // ukuran file 6 mb, 1000000 untuk 1 MB.
              alert("Maaf. Ukuran Gambar Terlalu Besar ! Maksimal Ukuran 6 MB");
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
    		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Batal</a>
    	</div>
    </form>
<?=content_close()?>

<?php  } else { ?>
<?=content_open('Status Lampu Lalu Lintas')?>

<?=$session->pull("info")?>
<div class="table-responsive-lg">
<table  id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
		<tr>
			<th>No</th>
			<th>Kode Status</th>
			<th>Nama Status</th>
			<th>Marker</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$getdata=$db->ObjectBuilder()->get('status_lampu');
			foreach ($getdata as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->kode_status?></td>
						<td><?=$row->nama_status?></td>
						<td class="text-center"><?=($row->marker==''?'-':'<img src="'.assets('unggah/marker/'.$row->marker).'" width="40px">')?></td>
						<td>
							<a href="<?=url($url.'&ubah&id='.$row->id_status)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
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