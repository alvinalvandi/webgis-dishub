<?php
  $session->destroy();
  $title="Membuat Laporan";
  $judul=$title;
  $url='laporkan';
  $setTemplate=false;
  ob_start();
  $content = ob_get_contents();
 ob_end_clean();
  $id_laporan="";
  $id_lampu="";
  $id_status=1;
  $nama="";
  $keterangan="";
  $latitude="";
  $longitude="";
  date_default_timezone_set('Asia/Jakarta');
  $tanggal= date("Y-m-d H:i:s");
  $status="Normal";
  $kevalidan="unvalid";

  if(isset($_POST['simpan'])){ 
  
    $img=upload('gambar','gambar');
   
    //mengecek agar tidak terjadi laporan 2 kali apabila lampu sedang diperbaiki
    if($_POST['id_laporan']==""){
    $db->where('id_lampu',$_POST['id_lampu']);
    $db->where('id_status', 2);
    $db->get('daftar_laporan');
    if($db->count>0){
      echo "<script> alert('Maaf, Lampu Ini Sedang Diperbaiki Terimakasih!');window.location='?halaman=beranda';</script>";
      return false;
    } 
      $db->where('id_lampu',$_POST['id_lampu']);
      $db->where('id_status', 6);
      $db->get('daftar_laporan');
    if($db->count>0){
        echo "<script> alert('Maaf, Lampu Ini Akan Segera Diperbaiki Terimakasih!');window.location='?halaman=beranda';</script>";
        return false;
    }  
      $data['id_lampu']=($_POST['id_lampu']);
      $data['id_status']=($_POST['id_status']);
      $data['nama']=htmlspecialchars($_POST['nama']);
      $data['keterangan']=htmlspecialchars($_POST['keterangan']);
      $data['latitude']=$_POST['latitude'];
      $data['longitude']=$_POST['longitude'];
      $data['tanggal']=$_POST['tanggal'];
      $data['gambar']=$img;
      $data['kevalidan']=$_POST['kevalidan'];
    
    $exec=$db->insert("daftar_laporan",$data);
  }
    if($exec){
      echo "<script> alert('Laporan Telah Dikirim, Terimakasih!');window.location='?halaman=beranda';</script>";
    
      } else{
      echo "<script> alert('Mohon Maaf, Laporan Gagal Dikirim!');history.go(-1);</script>";
     }
    
  } elseif(isset($_POST['simpan']) OR isset($_GET['lapor'])){
    
   $id_laporan="";
   $id_lampu="";
   $id_status=1;
   $nama="";
   $keterangan="";
   date_default_timezone_set('Asia/Jakarta');
   $tanggal= date("Y-m-d H:i:s");
   $status="Normal";
   $kevalidan="unvalid";

   if(isset($_GET['lapor']) AND isset($_GET['id'])){
    
    $id=$_GET['id'];
    $db->where('id_lampu',$id);
    $row=$db->ObjectBuilder()->getOne('daftar_lampu');
    if($db->count>0){
      
      $id_laporan="";
      $id_lampu=$row->id_lampu;
      $id_status=$row->id_status;
      $keterangan="";
      date_default_timezone_set('Asia/Jakarta');
      $tanggal= date("Y-m-d H:i:s");
      $alamat=$row->alamat;
      $kevalidan="unvalid";
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=isset($title)?$title:'Dinas Perhubungan'?></title>
    
    <!-- Bootstrap -->
    <link href="<?=templates()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=templates()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=templates()?>vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=templates()?>build/css/custom.min.css" rel="stylesheet">
    
 <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
 integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
 crossorigin=""/>
<link rel="stylesheet" href="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />
<style type="text/css">
  #mapid { height: 100vh; }
  .icon {
display: inline-block;
margin: 2px;
height: 16px;
width: 16px;
background-color: #ccc;
}
.icon-bar {
  background: url('assets/js/leaflet-panel-layers-master/examples/images/icons/bar.png') center center no-repeat;
}
</style>
  </head>

  <body class="nav-md" style="background-color:#325e69;">
    <div class="container body">
      <div class="main_container" style="background-color:#325e69;">
        <div class="col-md-3 left_col"style="background-color:#325e69;">
       
          <div class="left_col scroll-view" style="background-color:#325e69;">
            <div class="navbar nav_title" style="border:0; background-color:#325e69;">
            
              <a class="site_title"><i class="fa fa-globe" ></i> <span style="">Selamat Datang</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=templates()?>images/logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2>Website Dinas Perhubungan Kota Banda Aceh</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <div>
                 <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                  <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>

                  <br>
                </div><br>
               <h3>Menu Utama</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=url('beranda')?>"><i class="fa fa-map"></i> Home </a></li>
                  <li><a href="<?=url('laporkan')?>"><i class="fa fa-bullhorn"></i> Laporkan </a></li>
                  <li><a href="<?=url('about')?>"><i class="fa fa-info-circle"></i> About </a></li>
                </ul>
                
              </div>
            </div>
             
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=templates()?>images/dinas.jpg" alt="">Dinas Perhubungan Kota Banda Aceh
                    </a>
                    
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item text-center" href="<?=url('login')?>"> Masuk</a>
                    </div>
                  </li>
  
                  
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title?></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    
                      <ol class="breadcrumb">
                      <li style="width:25px;"></li>
                      <li><a href=""><i class="fa fa-th"></i> Halaman &nbsp</a></li>
                      <li class="active"><i class="fa fa-angle-right"></i> &nbsp<?= $judul?></li>
                      </ol>
     
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                  <h2><?'$title.'?></h2>
                  <ul class="nav navbar-right panel_toolbox">         
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              </ul>
            
    
    <?=content_open('Form Laporkan')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_laporan',$id_laporan)?>
    	<?=input_hidden('id_status',$id_status)?>
      <div class="form-group">
    		<label>Nama</label>
    		<div class="row">
	    		<div class="col-md-4">
	    			<?=input_text('nama',$nama)?>
		    	</div>
	    	</div>
      </div>
      <div class="form-group">
    		<label>Lokasi</label>
    		<div class="row">
	    		<div class="col-md-6">
	    		<?php
	    				$op['']='Pilih Lokasi Lampu';
	    				foreach ($db->ObjectBuilder()->get('daftar_lampu') as $row) {
	    					$op[$row->id_lampu]=$row->alamat;
	    				}
	    			?>
	    			<?=select('id_lampu',$op,$id_lampu)?>
		    	</div>
	    	</div>
      </div>
    	<div class="form-group">
    		<label>Keterangan</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=textarea('keterangan',$keterangan)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-3">
	    			<?=input_hidden('latitude',$latitude)?>
	    		</div>
	    		<div class="col-md-3">
	    			<?=input_hidden('longitude',$longitude)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_date('tanggal',$tanggal)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Gambar</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('gambar','')?>
    			</div>
    		</div>
    	</div>
      <div class="form-group">
    		<div class="row">
         <div class="col-md-4">
	    			<?=input_hidden('nama_status',$status)?>
	    			<?=input_hidden('kevalidan',$kevalidan)?>
	       </div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" name="simpan" onclick="tes()" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=url('beranda')?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
      </div>   
    </form>
    
<?=content_close()?>

        </div>
            </div>
          </div>
        </div>
<?php } else { ?>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=isset($title)?$title:'Dinas Perhubungan'?></title>
    
    <!-- Bootstrap -->
    <link href="<?=templates()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=templates()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=templates()?>vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=templates()?>build/css/custom.min.css" rel="stylesheet">
    
 <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
 integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
 crossorigin=""/>
<link rel="stylesheet" href="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />
<style type="text/css">
  #mapid { height: 100vh; }
  .icon {
display: inline-block;
margin: 2px;
height: 16px;
width: 16px;
background-color: #ccc;
}
.icon-bar {
  background: url('assets/js/leaflet-panel-layers-master/examples/images/icons/bar.png') center center no-repeat;
}
</style>
  </head>

  <body class="nav-md" style="background-color:#325e69;">
 
    <div class="container body">
      <div class="main_container" style="background-color:#325e69;">

        <div class="col-md-3 left_col"style="background-color:#325e69;">
        
          <div class="left_col scroll-view" style="background-color:#325e69;">
          
            <div class="navbar nav_title" style="border:0; background-color:#325e69;">
              <a class="site_title"><i class="fa fa-globe" ></i> <span style="">Selamat Datang</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=templates()?>images/logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2>Website Dinas Perhubungan Kota Banda Aceh</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <div>
                 <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                  <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>

                  <br>
                </div><br>
               <h3>Menu Utama</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=url('beranda')?>"><i class="fa fa-map"></i> Home </a></li>
                  <li><a href="<?=url('laporkan')?>"><i class="fa fa-bullhorn"></i> Laporkan </a></li>
                  <li><a href="<?=url('about')?>"><i class="fa fa-info-circle"></i> About </a></li>
                </ul>
                
              </div>
            </div>
             
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=templates()?>images/dinas.jpg" alt="">Dinas Perhubungan Kota Banda Aceh
                    </a>
                    
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item text-center" href="<?=url('login')?>"> Masuk</a>
                    </div>
                  </li>
  
                  
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title?></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    
                      <ol class="breadcrumb">
                      <li style="width:15px;"></li>
                      <li><a href=""><i class="fa fa-th"></i> Halaman &nbsp</a></li>
                      <li class="active"><i class="fa fa-angle-right"></i> &nbsp<?= $judul?></li>
                      </ol>
     
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                  <h2><?'$title.'?></h2>
                  <ul class="nav navbar-right panel_toolbox">         
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              </ul>
            
    
    <?=content_open('Form Laporkan')?>
   <form method="post" enctype="multipart/form-data">
    	<?=input_hidden('id_laporan',$id_laporan)?>
    	<?=input_hidden('id_status',$id_status)?>
      <div class="form-group">
    		<label>Nama</label>
    		<div class="row">
	    		<div class="col-md-4">
	    			<?=input_text('nama',$nama)?>
		    	</div>
	    	</div>
      </div>
      <div class="form-group">
    		<label>Lokasi</label>
    		<div class="row">
	    		<div class="col-md-4">
	    		<?php
	    				$op['']='Pilih Lokasi Lampu';
	    				foreach ($db->ObjectBuilder()->get('daftar_lampu') as $row) {
	    					$op[$row->id_lampu]=$row->alamat;
	    				}
	    			?>
	    			<?=select('id_lampu',$op,$id_lampu)?>
		    	</div>
	    	</div>
      </div>
    	<div class="form-group">
    		<label>Keterangan</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=textarea('keterangan',$keterangan)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-4">
          <div id="demo"></div>
  <script> 
 
  var x = document.getElementById("demo");

  if (navigator.geolocation) {
  
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    alert("Maaf, Geolocation tidak didukung oleh browser ini.");
  }
  function showPosition(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;
  .href="?halaman=laporkan&latitude=" + latitude + ",longitude=" + longitude;
  }
  function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "<p  style='color:red; '>Mohon Izinkan Akses Lokasi Jika Ingin Melapor !</p>"
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}
  </script>
 
	    			<?=input_hidden('latitude',$latitude)?>
	    		</div>
	    		<div class="col-md-3">
	    			<?=input_hidden('longitude',$longitude)?>
	    		</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_date('tanggal',$tanggal)?>
    			</div>
    		</div>
    	</div>
    	<div class="form-group">
    		<label>Gambar</label>
    		<div class="row">
	    		<div class="col-md-4">
    				<?=input_file('gambar','')?>
    			</div>
    		</div>
    	</div>
      <div class="form-group">
    		<div class="row">
         <div class="col-md-4">
	    			<?=input_hidden('nama_status',$status)?>
	    			<?=input_hidden('kevalidan',$kevalidan)?>
	       </div>
    		</div>
    	</div>
    	<div class="form-group">
    		<button type="submit" onclick="tes()" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Kirim</button>
			<a href="<?=url('beranda')?>" class="btn btn-danger" ><i class="fa fa-reply"></i> Kembali</a>
      </div>   
    </form>
    
<?=content_close()?>

        </div>
            </div>
          </div>
        </div>


  <?php } ?>
  <?php
    include '_layouts/footer.php';
    ?>
  <?php 
  include '_layouts/javascript.php';
?>
    
    <!-- Custom Theme Scripts -->
    <script src="<?=templates()?>build/js/custom.min.js"></script>
  </body>
</html>
