<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<?php
include "koneksi.php";

//baca isi table rfid_data

// mysqli_query($conn, "DELETE from rfid_data");

$sql = mysqli_query($conn, "SELECT * from rfid_data");
$data = mysqli_fetch_array($sql);
$uid = isset($data['uid']) ? $data['uid']:""; 
?>

<div class="form-group">
    <!-- <label style="font-weight:bold;">UID</label> -->
    <input type="text" name="uid" id="uid" placeholder
    ="Scan kartu RFID" class="form-control" style="width: 400px; text-align: center;" value="<?php
    echo $uid; ?>" readonly>
</div>





