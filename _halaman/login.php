<?php
  $title="Halaman Login";
  $setTemplate=false;
	if(isset($_POST['login'])){
    $nama_user=$_POST['nama_user'];
    $password=$_POST['password'];
    $db->where("nama_user",$nama_user);
    $data=$db->ObjectBuilder()->getOne("pengguna");
    if($db->count>0){
      // jika username ada
      $hash = $data->password;
      if (password_verify($password, $hash)) {
          $session->set("logged",true);
          $session->set("nama_user",$data->nama_user);
          $session->set("id_user",$data->id_user);
          $session->set("level",$data->level);
          echo "<script> alert('Anda Berhasil Login!');window.location='?halaman=pengguna';</script>";
      } else {
          echo "<script> alert('Username atau Password Salah!');window.location='?halaman=login';</script>";
      }
    } else {
      echo "<script> alert('Username atau Password Salah!');window.location='?halaman=login';</script>";
    }
  } else {
    $session->destroy();
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
  </head>

  <body class="login">
  
    <div>
    <div class="login_wrapper">
        <div class="animate form login_form">
        <div class="separator">
        
 
              <img src="<?=templates()?>images/dinasperhubungan1.jpg" class="profile_img" alt="" style="width:350px;">
               
             </div>
          <section class="login_content">
        
            <form method="post">
            <?=$session->pull("info")?>
              <h1>Login Form</h1>
              <label>Nama Pengguna</label>
              <div>
                <input type="text" class="form-control" name="nama_user" placeholder="Nama" required>
              </div>
              <label>Kata Sandi</label>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <div>
                <button type="submit" name="login" class="btn btn-warning"  style="color:white; height:35px; width:100px" >Sign in</button>
              </div>
         
            </form>
          </section>
        </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
