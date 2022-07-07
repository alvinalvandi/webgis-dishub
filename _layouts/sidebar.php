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
                <h2><?=$session->get("nama_user")?></h2>
                <i class="fa fa-circle text-success"> Online</i>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br/>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <div>
                 <hr style="border-top:5px dashed #e7e7e7">
                </div><br>
               <h3>Menu Utama</h3>
                <ul class="nav side-menu">
                
                  <li><a href="<?=url('pengguna')?>"><i class="fa fa-home"></i> Home</a></li>
                  <?php if ($session->get('level')=='Admin'): ?>
                    <li><a><i class="fa fa-map-marker"></i> Daftar Lampu<span class="fa fa-chevron-down"></span></a>
                     <ul class="nav child_menu">
                     <li><a href="<?=url('daftar_lampu')?>"><i class="fa fa-cog"></i>Kelola Lampu Lalu Lintas</a></li>
                     <li><a href="<?=url('status_lampu')?>"><i class="fa fa-spinner"></i>Status Lampu Lalu Lintas</a></li>
                    </ul>
                  </li>
                  
                    <li><a><i class="fa fa-envelope"></i> Data Laporan Petugas<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="<?=url('daftar_laporan')?>"><i class="fa fa-folder-open-o"></i>Daftar Laporan Valid</a></li>
                    <li><a href="<?=url('daftar_laporan_dikerjakan')?>"><i class="fa fa-clock-o"></i>Daftar Laporan Dikerjakan</a></li>
                    <li><a href="<?=url('daftar_laporan_valid')?>"><i class="fa fa-book"></i>Riwayat Perbaikan</a></li>
                    </ul>
                    </li>
                    <?php endif ?>

                    <?php if ($session->get('level')=='Petugas'): ?>
                 <li>
                    <a href="<?=url('verifikasi_laporan')?>">
                    <i class="fa fa-folder-open-o"></i> Daftar Laporan Masuk</a>
                 </li>
                 <li>
                    <a href="<?=url('proses_perbaikan')?>">
                    <i class="fa fa-exclamation-triangle"></i> Lampu Harus Diperbaiki</a>
                 </li>
                  <li>
                    <a href="<?=url('riwayat_perbaikan')?>">
                    <i class="fa fa-spinner"></i> Lampu Sedang Diperbaiki</a>
                  </li>
                  <li>
                    <a href="<?=url('riwayat_laporan')?>">
                    <i class="fa fa-book"></i> Riwayat Laporan</a>
                  </li>
                  <?php endif ?>

          
                  <li><a href="<?=url('logout')?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
                  
                </ul>
                
              </div>
            </div>
             
            <!-- /sidebar menu -->

          </div>
        </div>
