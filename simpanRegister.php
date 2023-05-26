<?php
    include "koneksi.php";

    if(isset($_POST['save'])){
        $uid = $_POST['uid'];  
        $user = $_POST['user'];

        // die($user);
        
        $simpan = mysqli_query($conn,"INSERT into user(uid, user)VALUES('$uid','$user')");
    // die($simpan);
        // ,'$nama_oli','$type_oli','$history','$lokasi','$new_img_name
        mysqli_query($conn, "DELETE from rfid_data");
        header("location:loginbckup.php");
        
    }
    

?>