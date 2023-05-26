<?php
    include "koneksi.php";
    
    $uid = $_GET['uid'];
    //$uid = isset($_GET['uid']) ? $_GET['uid']:'';
    mysqli_query($conn, "delete from data_rekapitulasi");

    //simpan nomer kartu yang baru
    $simpan = mysqli_query($conn, "INSERT into data_rekapitulasi set uid='".$uid."', id_brand='1', id_type='1', id_oli='1', id_typeoli='1' ");
  
    if($simpan)
        echo "berhasil";
    else
        echo "gagal";

    
?> 