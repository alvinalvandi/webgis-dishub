<?php
        class Motor{
            public $nama;
            public $jenis;
            public function __construct($namaMotor, $jenisMotor){
                $this->nama=$namaMotor;
                $this->jenis=$jenisMotor;
            }

            public function cetakNama(){
                echo "ini adalah motor " . $this->nama;
            }
        }

        class Jenis extends Motor{
     
      
           public function lengkap(){
                echo "yang berjenis"  . $this->jenis;
            }
        }

    $supra = new Jenis("Supra X"," Honda");
    $supra->cetakNama();
    $supra->lengkap();

    // <table>
    //  <thead>
    //         <tr>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //         </tr>
    //   </thead>
    //   <tbody>
    //         <tr>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //             <th></th>
    //         </tr>
    //   </tbody>
    // </table>
?>