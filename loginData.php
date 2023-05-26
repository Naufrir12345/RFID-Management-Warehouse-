<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php 
    include "koneksi.php";
    $sql = mysqli_query($conn, "SELECT * from rfid_data");
    $data = mysqli_fetch_array($sql);
    $uid = isset($data['uid']) ? $data['uid']:"";
    // $mac = isset($data['device']) ? $data['device']:"";
?>
<form>
        <input type="text" id="uid" name="uid" class="fadeIn second" placeholder=".:: SCAN KARTU ::."
        value="<?php echo $uid; ?>" readonly>
            
        <!-- <input type="text" id="device" name="login" class="fadeIn third"  placeholder=".:: DEVICE ::."
        value="<?php
            if ($mac == "40:F5:20:28:2B:DC"){
                echo "Scanner 1 \n";
            }else if($mac == "C8:C9:A3:54:F5:14"){
                echo "Scanner 2 \n";
            }
        ?>" readonly> -->
    </form>
