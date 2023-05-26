<?php
    include "koneksi.php";
    
    //$uid =  trim(str_replace(" ", "-", $_GET['IDTAG'] )) ;
    $uid =  isset($_GET['IDTAG']) ? $_GET['IDTAG']:"";
    $id_brand = 1;
    $id_type = 1;
    $id_oli = 1;
    $id_typeoli = 1;
    $id_satuan = 1;
    $id_kategori = 1;

    //echo $uid;
    // die($uid);
    //$uid = isset($_GET['uid']) ? $_GET['uid']:'';
    //mysqli_query($conn, "delete from data_rekapitulasi");

    //simpan nomer kartu yang baru
    // $simpan = mysqli_query($conn, "INSERT into data_rekapitulasi set uid='".$uid."', id_brand='1', id_type='1', id_kategori='1', id_satuan='1',
    // id_oli='1', id_typeoli='1' ");


    $check = mysqli_query($conn, "SELECT uid from data_rekapitulasi where uid = '$uid'");
    $row = mysqli_fetch_array($check);
    
    if($row){
        $get_data = mysqli_query($conn,"SELECT brand, type_brand, nama_oli, type_oli, kategori, satuan, kapasitas FROM view_rekapitulasi where uid = '$uid'");
        $row = mysqli_fetch_array($get_data);
        echo $row['brand'];
    }
    else{
        $simpan = mysqli_query($conn, "INSERT into data_rekapitulasi(uid, id_brand, id_type, id_oli, id_typeoli, id_satuan, id_kategori)values('$uid', '1','1','1','1','1','1')");
        if($simpan){
            echo "berhasil simpan";
        }else{
            echo "gagal simpan";
        }
    }
        

    
?> 