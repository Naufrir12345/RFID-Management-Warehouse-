<?php

//membuat koneksi ke database
//$koneksi = mysqli_connect("localhost", "root", "", "latihan");

include "koneksi.php";

//variabel nim yang dikirimkan form.php
// $uid = $_GET['uid'];
if (isset($_GET['item_number'])) {
    $item_number = $_GET['item_number'];

    $sql_pendaftar = "SELECT * FROM item_code where item_number = '$item_number'";
    $result_pendaftar = mysqli_query($conn, $sql_pendaftar);
    $data_pendaftar = mysqli_fetch_array($result_pendaftar);

   $data = array(
   'item_name'      =>  $data_pendaftar['item_name'],
   'unit'      =>  $data_pendaftar['unit'],
);

   //tampil data
   echo json_encode($data);
 }

?>