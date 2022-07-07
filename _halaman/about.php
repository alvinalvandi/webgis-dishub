<?php
  $session->destroy();
  $title="Halaman Bantuan";
  $judul=$title;
  $setTemplate=false;
 
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
                <hr style="border-top:5px dashed #e7e7e7">
                </div><br>
               <h3>Menu Utama</h3>
                <ul class="nav side-menu">
                  <li><a  href="<?=url('beranda')?>"><i class="fa fa-home"></i> Home </a></li>
                  <li><a href="<?=url('laporkan')?>"><i class="fa fa-bullhorn"></i> Laporkan </a></li>
                  <li><a href="<?=url('about')?>"><i class="fa fa-info-circle"></i> Bantuan </a></li>
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
                <i class="fa fa-caret-left" style="font-size:21px; position:absolute; margin-right:40px; margin-top:16px"> Menu Utama</i>
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=templates()?>images/dinas.jpg" >Login
                    </a>
                    
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item text-center" href="<?=url('login')?>"><i class="fa fa-user">&nbsp</i> Masuk</a>
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
                      <li style="width:100%;"></li>
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
              <li><a class="collapse-link"><i class="fa fa-chevron-down" style="padding-left: 50px;"></i></a>
              </li>
              </ul>

  <?=content_open($title)?>
  <div style="font-size:17px">WebGIS ini merupakan Web Dinas Perhubungan Kota Banda Aceh dalam mengelola dan 
  merawat Lampu Lalu Lintas Kota Banda Aceh.</div>
  <div style="font-size:17px">WebGIS Dinas Perhubungan Kota Banda Aceh ini bertujuan untuk menampung segala laporan dari masyarakat
  mengenai lampu lalu lintas Kota Banda Aceh yang dalam kondisi rusak atau tidak berfungsi dengan normal, 
  sehingga apabila terdapat laporan mengenai lampu lalu lintas, petugas lapangan akan langsung menanggapinya.</div>
  <div style="font-size:17px"><br> # Tata Cara Penggunaan Aplikasi # </br>
  <div style="color:red">Harap Izinkan Akses Lokasi Ketika Ingin Melapor Untuk Menghindari Pelaporan Palsu!</div>
  1. Melapor melalui halaman laporkan <br>
  -mengizinkan akses lokasi <br>
  -mengisi form nama, NIK/NISN, no HP, lokasi lampu, keterangan lampu yang rusak atau bermasalah dan mengirim foto bagian lampu yang rusak <br>
  -menekan tombol kirim
  <br>
  2. Melapor melalui marker <br>
  -mengizinkan akses lokasi <br>
  -menekan tombol laporkan pada marker lokasi lampu lalu lintas di peta <br>
  -mengisi form nama, NIK/NISN, no HP, keterangan lampu yang rusak atau bermasalah dan mengirim foto bagian lampu yang rusak, sedangkan untuk lokasi lampu akan otomatis terinput
  <br>
  -menekan tombol kirim
  </div>
  <br><div style="font-size:17px"> # Tata Cara Login Aplikasi # </br> 
  -Menekan tulisan Login pada pojok kanan atas Aplikasi <br>
  -menekan tombol masuk <br>
  -mengisi form login nama pengguna dan password <br>
  -menekan tombol sign in</div>
  <?=content_close()?>
  
        </div>
            </div>
          </div>
        </div>
        <?php
    include '_layouts/footer.php';
    ?>
  <?php 
  include '_layouts/javascript.php';
?>
    
  </body>
</html>
