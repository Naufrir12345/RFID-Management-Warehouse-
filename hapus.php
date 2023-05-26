<?php
    
    $servername = "localhost";  
    $username = "root";
    $password = "";
    $dbname = "rfid_database";
   
$mysqli = new mysqli($servername, $username, $password, $dbname);

    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        if(!empty($uid)){
            $sql="DELETE FROM registrasi WHERE uid='$uid'";
              
            if($mysqli->query($sql) === false) { // Jika gagal meng-hapus data tampilkan pesan dibawah 'Perintah SQL Salah'
              trigger_error('Perintah SQL Salah: ' . $sql . '');
            } else { // Jika berhasil alihkan ke halaman tampil.php
              header('location: rekapitulasidata.php');
            }
        }
    }
?>