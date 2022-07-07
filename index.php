<?php
 include '_loader.php';
 $setTemplate=true;
 if(isset($_GET['halaman'])){
    $halaman=$_GET['halaman'];
  }
  else{
    $halaman='beranda';
  }
  ob_start();
  $file='_halaman/'.$halaman.'.php';
  if(!file_exists($file)){
    include '_halaman/error.php';
  }
  else{
    include $file;
  }
  $content = ob_get_contents();
  ob_end_clean();

  if($setTemplate==true){
     if($session->get("logged")!==true){
      redirect(url('beranda'));
     } 
?>
<!DOCTYPE html>
<html lang="en">
<?php include '_layouts/head.php'?>
<body class="nav-md" style="background-color:#325e69;">
    <div class="container body">
      <div class="main_container" style="background-color:#325e69;">
    <?php
  include '_layouts/header.php';
  include '_layouts/sidebar.php';
   ?>
 <!-- page content -->
      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?=$judul?></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    
                      <ol class="breadcrumb">
                      <li></li>
                      <li><a href=""><i class="fa fa-th"></i> Halaman &nbsp</a></li>
                      <li class="active"><i class="fa fa-angle-right"></i> &nbsp<?=$judul?></li>
                      </ol>
     
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
               
              <ul class="nav navbar-right panel_toolbox">         
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              </ul>
              <?php
              echo $content;
              ?>
            </div>
            </div>
          </div>
        </div>
<!-- footer content -->
    <?php
    include '_layouts/footer.php';
    ?>
  <?php 
  include '_layouts/javascript.php';
?>

</body>

</html>
<?php } else {
  echo $content;
}

if(isset($fileJs)){
  include '_halaman/js/'.$fileJs.'.php';
}
?>