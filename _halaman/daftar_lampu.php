<?php if ($session->get('level')=='Admin'){ ?>
<?php
  $title="Kelola Lampu Lalu Lintas";
  $judul=$title;
  $fileJs='lokasilampuJs';
  $url='daftar_lampu';

if(isset($_POST['simpan'])){
	
	if (isset($_GET['tambah']) && (!is_numeric($_POST['latitude']) || !is_numeric($_POST['longitude'])))  {
		echo "<script> alert('Latitude atau Longitude harus dalam bentuk angka decimal (titik bukan koma)!');window.location='?halaman=daftar_lampu&tambah';</script>";
		return false;
	} elseif (isset($_GET['ubah']) && (!is_numeric($_POST['latitude']) || !is_numeric($_POST['longitude'])))  {
		echo "<script> alert('Latitude atau Longitude harus dalam bentuk angka decimal (titik bukan koma)!');history.go(-1);</script>";
		return false;
	} else {
		
	$data['id_status']=$_POST['id_status'];
	$data['latitude']=$_POST['latitude'];
	$data['longitude']=$_POST['longitude'];
	$data['alamat']=$_POST['alamat'];
	if($_POST['id_lampu']==""){
		
		$exec=$db->insert("daftar_lampu",$data);
		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses Ditambah </div>';
		
	}
	else{
		$db->where('id_lampu',$_POST['id_lampu']);
		$exec=$db->update("daftar_lampu",$data);
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
}

if(isset($_GET['hapus'])){
	$setTemplate=false;
	$db->where("id_lampu",$_GET['id']);
	$exec=$db->delete("daftar_lampu");
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

elseif(isset($_GET['tambah']) OR isset($_GET['ubah'])){
	
  $id_lampu="";
  $id_status="";
  $latitude="";
  $longitude="";
  $alamat="";
  
  if(isset($_GET['ubah']) AND isset($_GET['id'])){
  	$id=$_GET['id'];
  	$db->where('id_lampu',$id);
	$row=$db->ObjectBuilder()->getOne('daftar_lampu');
	if($db->count>0){
		$id_lampu=$row->id_lampu;
		$id_status=$row->id_status;
		$latitude=$row->latitude;
		$longitude=$row->longitude;
		$alamat=$row->alamat;
	}
  }
?>
<?=content_open('Form Kelola Lampu Lalu Lintas')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_lampu',$id_lampu)?>
    	<div class="form-group">
    		<label>Titik Koordinat</label> 
    		<div class="row">
	    		<div class="col-md-3" id="tes">
	    			<?=input_text('latitude',$latitude, '','placeholder="latitude"')?>
	    		</div>
                <div class="col-md-3" id="tes">
	    			<?=input_text('longitude',$longitude, '','placeholder="longitude"')?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Alamat</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=textarea('alamat',$alamat)?>
    			</div>
    		</div>
    	</div>
        <div class="form-group">
    		<label>Status</label>
    		<div class="row">
	    		<div class="col-md-4">
	    			<?php
	    				$kat['']='Pilih Status Lampu';
	    				foreach ($db->ObjectBuilder()->get('status_lampu') as $row) {
	    					$kat[$row->id_status]=$row->nama_status;
	    				}
	    			?>
	    			<?=select('id_status',$kat,$id_status)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Batal</a>
    	</div>
    </form>
<?=content_close()?>

<?php  } elseif(isset($_GET['lokasilampu']) AND isset($_GET['id'])) {
	

	?>
	<div>
	<button style="margin-left:1px" onclick="window.location='?halaman=daftar_lampu'" class="btn btn-info">Kembali</button>
	</div>
	<?=content_open('Halaman Cek Lokasi Lampu')?>
	
	<div id="mapid"></div>
	<?=content_close()?>
	
	<?php  } else { ?>
<?=content_open('Data Lampu Lalu Lintas')?>

<a href="<?=url($url.'&tambah')?>" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
<hr>
<?=$session->pull("info")?>
<div class="table-responsive-lg">
<table id="table_id" class="table table-bordered display">
	<thead style="background-color:#3d5c58; color:white;">
		<tr>
			<th>No</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>Alamat</th>
			<th>Status</th>
			<th>Marker</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$db->join('status_lampu b','a.id_status=b.id_status','LEFT');
			$getdata=$db->ObjectBuilder()->get('daftar_lampu a');
			foreach ($getdata as $row) {
				?>
					<tr>
						<td><?=$no?></td>
						<td><?=$row->latitude?></td>
						<td><?=$row->longitude?></td>
						<td><?=$row->alamat?></td>
						<td><?=$row->nama_status?></td>
						<td class="text-center"><?=($row->marker==''?'-':'<img src="'.assets('unggah/marker/'.$row->marker).'" width="40px">')?></td>
						<td>
							<a href="<?=url($url.'&ubah&id='.$row->id_lampu)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
							<a href="<?=url($url.'&hapus&id='.$row->id_lampu)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
							<a href="<?=url($url.'&lokasilampu&id='.$row->id_lampu.'&lati='.$row->latitude.'&longi='.$row->longitude)?>" class="btn btn-warning"><i class="fa fa-map-marker"></i> Lokasi</a>
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
	