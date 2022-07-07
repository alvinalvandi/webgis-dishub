<?php
  function upload($a='',$b='',$c=''){
      $handle = new \Verot\Upload\Upload($_FILES[$a]);
      $ex=explode('.',$_FILES[$a]['name']); //terdapat 2 array asosiat berisi string yaitu nama file dan ext file, TITIK sbg pemisah
      $ext=$ex[(count($ex)-1)]; //extensi setelah nama file yang di tampung di array $ex yang hasilnya $ex[1] karena 2-1
      //2 merupakan hasil dari count($ex)
      //count akan mereturn nomor elemen pada array
      if ($handle->uploaded) {
            $handle->file_new_name_body=rand(1,100).date('dmyhis');
            $handle->file_new_name_ext=$ext;
            $handle->file_force_extension=false;
            $handle->file_overwrite=true;
            $handle->forbidden = array('application/*');
            $handle->file_max_size = '6000000'; // 6MB
            $handle->file_safe_name = true; //spasi pada nama file diganti dengan tanda garis bawah " _ "
            $handle->jpeg_quality = 50;
            $handle->allowed = array('image/*');
            $handle->process($c.'assets/unggah/'.$b.'/');
            if ($handle->processed) {
                return $handle->file_dst_name;
            } 
            else{
                
                return false;
            }
      }
     
  }