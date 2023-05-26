<?php
    include "koneksi.php";

    if(isset($_POST['save'])){
        $uid = $_POST['uid'];  
        $device = $_POST['device'];
        // $item_number = $_POST['item_number'];
        // $item_name = $_POST['item_name'];
        // $unit = $_POST['unit'];
        $note = $_POST['note'];
        $qty = $_POST['qty'];
        $qty_konfersi = $_POST['qty_konfersi'];
        
        // $tanggal = $_POST['tanggal_registrasi'];
        // die($tanggal);
        $lokasi = $_POST['id_lokasi'];
        // $history = $_POST['history'];
        // $kategori = $_POST['id_kategori'];
        // $lokasi = $_POST['id_lokasi'];

        echo "<pre>";
        print_r($_FILES['my_image']);
        echo "</pre>";
    
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];
    
        
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = './uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                }

        //die ($uid);
        $simpan = mysqli_query($conn,"INSERT into log_activity(uid, device, note, qty, qty_konfersi, upload, id_lokasi)VALUES('$uid','$device',
        '$note','$qty','$qty_konfersi','$new_img_name','$lokasi')");
    
        // ,'$nama_oli','$type_oli','$history','$lokasi','$new_img_name
        mysqli_query($conn, "DELETE from rfid_data");
        header("location:transaksi.php?uid=$uid");
        
        
        
        
    }
    

?>