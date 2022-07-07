<?php
  $title="Pengguna";
  $judul=$title;
  $url='pengguna';
  $fileJs='markerpenggunaJs';
?>
<?=content_open('Halaman Pengguna')?>
    <?=$session->pull("info")?>
    <div id="mapid"></div>
<?=content_close()?>
