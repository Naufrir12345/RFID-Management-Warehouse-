<?php
  $servername = "localhost";
  $database = "rfid_database";
  $username = "root";
  $password = "";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $database);
    //$uid =  trim(str_replace(" ", "-", $_GET['IDTAG'] )) ;
    $uid =  isset($_GET['IDTAG']) ? $_GET['IDTAG']:"";
    $mac = isset($_GET['MAC']) ? $_GET['MAC']:"";
    
    $id_brand = 1;
    $id_type = 1;
    $id_oli = 1;
    $id_typeoli = 1;
    $id_satuan = 1;
    $id_kategori = 1;
    
    $check = mysqli_query($conn, "SELECT uid from registrasi where uid = '$uid'");
    $row = mysqli_fetch_array($check);
    
    //$uid = isset($_GET['uid']) ? $_GET['uid']:"";
    
    if($row){
        $get_data = mysqli_query($conn,"SELECT item_number, item_name, unit, note, tanggal_registrasi FROM registrasi where uid = '$uid'");
        $row = mysqli_fetch_array($get_data);
        echo $row['item_number'];
        $simpan = mysqli_query($conn, "INSERT into rfid_data(uid, device)values('$uid','$mac' )");
        if($simpan){
            echo "berhasil simpan";
            //header("Location: loginbckup.php");
        }else{
            echo "gagal simpan";
        }
    }
    else{
        $simpan = mysqli_query($conn, "INSERT into rfid_data(uid, device)values('$uid','$mac' )");
        if($simpan){
            echo "berhasil simpan";
            //header("Location: loginbckup.php");
        }else{
            echo "gagal simpan";
            
        }
    }
    
?> 
