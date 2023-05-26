<?php 
 
include 'koneksi.php';


if (isset($_POST['Simpan']) && isset($_FILES['my_image'])) {
	include "koneksi.php";
        $uid = $_POST['uid'];  
        //$device = $_POST['device'];
        $item_number = $_POST['item_number'];
        $item_name = $_POST['item_name'];
        $unit = $_POST['unit'];
        $lokasi = $_POST['id_lokasi'];
        $qty = $_POST['qty'];
        $qty_konfersi = $_POST['qty_konfersi'];
        $note = $_POST['note'];

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
		
// die($new_img_name);
   $sql= mysqli_query($conn, 
      "UPDATE registrasi SET item_number='$item_number', 
      item_name='$item_name', 
      unit='$unit', 
      note='$note', 
      id_lokasi='$lokasi', 
      qty='$qty', 
      qty_konfersi='$qty_konfersi', 
      upload='$new_img_name' 
      WHERE uid='$uid'");
   
}else {
	header("Location: index.php");
}
// if($_POST['upload']){
// 	$ekstensi_diperbolehkan	= array('png','jpg', 'jpeg');
// 	$upload = $_FILES['file']['name'];
// 	$x = explode('.', $upload);
// 	$ekstensi = strtolower(end($x));
// 	$ukuran	= $_FILES['file']['size'];
// 	$file_tmp = $_FILES['file']['tmp_name'];	
// 		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
// 		    if($ukuran < 1044070){			
// 			move_uploaded_file($file_tmp, 'images/'.$upload);
         
//          }
//       }	
//    }
 

echo $sql;
header("location:rekapitulasidata.php");
 
?>