<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<?php
include "koneksi.php";

//baca isi table rfid_data

// mysqli_query($conn, "DELETE from rfid_data");

$sql = mysqli_query($conn, "SELECT * from rfid_data");
$data = mysqli_fetch_array($sql);
$uid = isset($data['uid']) ? $data['uid']:""; 
$mac = isset($data['device']) ? $data['device']:"";

    //$uid = isset($_GET['uid']) ? $_GET['uid']:"";
   
// DATA SCANNER NAME
?>
<div class="container-fluid">
     <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label style="font-weight:bold;">UID</label>
                <input type="text" name="uid" id="uid" placeholder
                ="Scan kartu RFID" class="form-control" style="width: 200px" value="<?php
                echo $uid; ?>" readonly>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="form-group">    
                <label style="font-weight:bold;">Nama Device</label>
                <input type="text" name="device" id="device" placeholder
                ="Scan kartu RFID" class="form-control" style="width: 200px"value="<?php
                if ($mac == "40:F5:20:28:2B:DC"){
                    echo "Scanner 1 \n";
                }else if($mac == "C8:C9:A3:54:F5:14"){
                    echo "Scanner 2 \n";
                }
                ?>" readonly>
            </div>
        </div>
     </div>
</div>





