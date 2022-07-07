<?php if ($session->get('level')=='Petugas'){ ?>
<?php
  $title="Daftar Laporan Warga";
  $judul=$title;
  $url='proses_perbaikan';
  $id_perbaikan="";
  if (isset($_GET['id'])) {
    $db->where('id_laporan',$_GET['id']);
    $id_laporan=$_GET['id'];
  }
  $petugas_perbaikan="";
  $keterangan_perbaikan="";
  date_default_timezone_set('Asia/Jakarta');
  $tanggal_perbaikan= date("Y-m-d H:i:s");

  if(isset($_POST['fix'])){
	$setTemplate=false;

    $db->ObjectBuilder()->getOne('daftar_laporan');
    $db->where('id_laporan',$_GET['id']);
    $datas['id_status']=2;

    $get1=$db->ObjectBuilder()->getOne('daftar_laporan');
    $db->where('id_laporan',$_GET['id']);
    $exec=$db->update("daftar_laporan",$datas);

    $lampu=$get1->id_lampu;
    $db->ObjectBuilder()->get('daftar_lampu');
    $db->where('id_lampu',$lampu);
    
    $exec2=$db->update("daftar_lampu",$datas);

        $db->get('proses_perbaikan');
		if($_POST['id_perbaikan']==""){
            $db->where('id_perbaikan',$_POST['id_perbaikan']);
            $db->getOne('proses_perbaikan');
     
            $data['id_laporan']=$_POST['id_laporan'];
            $data['petugas_perbaikan']=htmlspecialchars($_POST['petugas_perbaikan']);
            $data['keterangan_perbaikan']=htmlspecialchars($_POST['keterangan_perbaikan']);
            $data['tanggal_perbaikan']=$_POST['tanggal_perbaikan'];
          $exec3=$db->insert("proses_perbaikan",$data);
        }

		$info='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Status Lampu telah berubah!</div>';

	if($exec && $exec2){
        if ($exec3) {
            $session->set('info',$info);
        }
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
 elseif(isset($_GET['perbaiki']) AND isset($_GET['id'])) { 
?>

<?=content_open('Form Perbaikan Lampu')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_perbaikan',$id_perbaikan)?>
    	<?=input_hidden('id_laporan',$id_laporan)?>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-3"><label>Nama Petugas</label> 
	    			<?=input_text('petugas_perbaikan',$petugas_perbaikan)?>
	    		</div>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="row">
	    	<div class="col-md-3"><label>Keterangan Perbaikan</label> 
	    			<?=textarea('keterangan_perbaikan',$keterangan_perbaikan)?>
	    		</div>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="row">
	    		<div class="col-md-4">
                    <?=input_date('_perbaikan',$tanggal_perbaikan)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="fix" class="btn btn-info"><i class="fa fa-refresh"></i> Mulai Perbaikan</button>
			<a href="<?=url($url)?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Batal</a>
    	</div>
    </form>
<?=content_close()?>

<?php } else { ?>

    <?=content_open('Data Laporan Wargaa')?>
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
			<th>Gambar</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$kevalidan = "Valid";
			$id_status =6;
			$no=1;
			$db->join('status_lampu c','c.id_status=6','LEFT');
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
						<td><?php if ($row->id_status=='6') {
							echo 'Perlu Perbaikan';
						} ?></td>
						<td class="text-center "><a class="fancybox-effects-c" href="<?=assets('unggah/gambar/'.$row->gambar);?>" title="<?=$row->keterangan?>" alt="gambar"><?=('<img src="'.assets('unggah/gambar/'.$row->gambar).'" width="50px">')?></a></td>
						<td>
						<a style="margin-bottom:5px" href="<?=url($url.'&perbaiki&id='.$row->id_laporan)?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Perbaiki</a>
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