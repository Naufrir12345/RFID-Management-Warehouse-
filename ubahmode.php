<?php
    include "koneksi.php";
    // $uid = isset($_GET['uid']) ? $_GET['uid']:"";
    //baca mode terakhir
    $mode = mysqli_query($conn, "SELECT * from status_data");
    $data_mode = mysqli_fetch_array($mode);
    $mode_absen = isset($data_mode['mode']) ? $data_mode['mode']:'';

    $mode_absen = $mode_absen + 1;
    if($mode_absen > 3)
        $mode_absen = 1;
    
    $simpan = mysqli_query($conn, "UPDATE status_data set mode='$mode_absen'");
    // $ganti = mysqli_query($conn, "UPDATE registrasi set mode='$mode_absen' WHERE uid='$uid'");
    // print_r($mode_absen); die();
    if($simpan)
        echo "$mode_absen";
    else
        echo "tidak tersimpan";
    
?>   