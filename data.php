<?php  
include "koneksi.php";

if (isset($_GET['item_number'])) {
    $id_pendaftar = $_GET['item_number'];
    //echo $id_pendaftar;

    $sql_pendaftar = "SELECT * FROM item_code where item_number='$id_pendaftar'";
    $result_pendaftar = mysqli_query($conn, $sql_pendaftar);
    
    $data_pendaftar = mysqli_fetch_array($result_pendaftar);

    if ($data_pendaftar == null){
        echo 'hah';
    }else{
        echo $data_pendaftar[1];
        echo $data_pendaftar[2];
        echo $data_pendaftar[3];
    }
    
   }else{
    echo 'data kosong';
   }

//$item_number = isset($_GET['item_number']);

// $data = array(
//     'item_name'      =>  $data['item_name'],
//     'unit'      =>  $data['unit']
// );

// echo json_encode($data);
?>